from PIL import Image
from collections import deque

src = r"E:\MoskowNexus\public\assets\imgs\page\homepage1\ai-strategy-console.png"
raw = r"E:\MoskowNexus\.superdesign\tmp\try-e.png"

im = Image.open(raw).convert("RGBA")
w, h = im.size
px = im.load()

samples = []
for y in range(12):
    for x in range(12):
        samples.append(px[x, y][:3])
        samples.append(px[w - 1 - x, y][:3])
        samples.append(px[x, h - 1 - y][:3])
        samples.append(px[w - 1 - x, h - 1 - y][:3])
n = len(samples)
bg = (
    sum(p[0] for p in samples) / n,
    sum(p[1] for p in samples) / n,
    sum(p[2] for p in samples) / n,
)

THRESHOLD = 26
LUMA_MAX = 55

def close_to_bg(c):
    d2 = (c[0] - bg[0]) ** 2 + (c[1] - bg[1]) ** 2 + (c[2] - bg[2]) ** 2
    L = 0.2126 * c[0] + 0.7152 * c[1] + 0.0722 * c[2]
    return d2 < THRESHOLD * THRESHOLD and L < LUMA_MAX

visited = [[False] * w for _ in range(h)]
q = deque()

def try_seed(x, y):
    if 0 <= x < w and 0 <= y < h and not visited[y][x] and close_to_bg(px[x, y][:3]):
        visited[y][x] = True
        q.append((x, y))

for x in range(w):
    try_seed(x, 0)
    try_seed(x, h - 1)
for y in range(h):
    try_seed(0, y)
    try_seed(w - 1, y)

while q:
    x, y = q.popleft()
    r, g, b, _ = px[x, y]
    px[x, y] = (r, g, b, 0)
    for nx, ny in ((x - 1, y), (x + 1, y), (x, y - 1), (x, y + 1)):
        if 0 <= nx < w and 0 <= ny < h and not visited[ny][nx] and close_to_bg(px[nx, ny][:3]):
            visited[ny][nx] = True
            q.append((nx, ny))

# Стереть только тонкий обрывок у левого края (x < 5), не трогая панель «стратегии»
for y in range(h):
    for x in range(5):
        r, g, b, a = px[x, y]
        if a == 0:
            continue
        # вертикальный штрих/рамка обрывка — не широкая панель
        px[x, y] = (r, g, b, 0)

for y in range(h):
    for x in range(w):
        if px[x, y][3] == 0:
            continue
        c = px[x, y][:3]
        L = 0.2126 * c[0] + 0.7152 * c[1] + 0.0722 * c[2]
        d = ((c[0] - bg[0]) ** 2 + (c[1] - bg[1]) ** 2 + (c[2] - bg[2]) ** 2) ** 0.5
        touch = any(
            0 <= nx < w and 0 <= ny < h and px[nx, ny][3] == 0
            for nx, ny in ((x - 1, y), (x + 1, y), (x, y - 1), (x, y + 1))
        )
        if touch and d < 40 and L < 65:
            px[x, y] = (*c, int(max(0, min(255, (d - 12) / 28 * 255))))

bbox = im.getbbox()
if bbox:
    pad = 2
    im = im.crop((
        max(0, bbox[0] - pad),
        max(0, bbox[1] - pad),
        min(w, bbox[2] + pad),
        min(h, bbox[3] + pad),
    ))

im.save(src, optimize=True)
cw, ch = im.size
board = Image.new("RGBA", (cw, ch))
bp = board.load()
tile = 16
for y in range(ch):
    for x in range(cw):
        bp[x, y] = (210, 210, 210, 255) if ((x // tile) + (y // tile)) % 2 == 0 else (160, 160, 160, 255)
Image.alpha_composite(board, im).save(r"E:\MoskowNexus\.superdesign\tmp\ai-strategy-console-checker.png")
print("saved", im.size)
