<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>НЕКСУС — Архитектор капитала</title>
<meta name="description" content="Демонстрационная инвестиционная симуляция НЕКСУС: детектив-расследования проектов, кризисный симулятор, портфель и токенизация."/>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Inter+Tight:wght@700;800;900&family=JetBrains+Mono:wght@500;700&family=Unbounded:wght@500;600;700&display=swap" rel="stylesheet"/>
<script src="https://unpkg.com/react@18.3.1/umd/react.development.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@18.3.1/umd/react-dom.development.js" crossorigin></script>
<script src="https://unpkg.com/@babel/standalone@7.24.7/babel.min.js" crossorigin></script>
<script>
window.NEXUS_LOGO_PATH = "M67.44,76.62c-0.62,4.03-5.52,12.64-8.44,15.58c-3.96,4.03-9.78,7.08-17.29,4.9c0.83-3.59,6.55-11.66,6.35-22.89c-0.1-3.38-0.94-5.45-1.77-8.18c-1.36,0.33-3.65,1.64-4.9,2.18c0.42,2.73,1.25,3.49,1.25,6.98c0,8.18-3.54,12.97-5.62,18.96c-1.36-0.65-3.54-3.91-4.48-5.89c-4.06-9.16-0.42-17.11,1.87-26.15c2.29-8.83,3.44-18.2-1.77-26.15c-1.15-1.64-3.44-4.58-5.32-5.01c-0.52,0.55-2.39,4.14-2.49,4.9c1.87,0.88,3.65,3.49,4.68,5.78c3.64,7.96-0.42,19.17-2.39,26.82c-2.49,9.27-2.91,17.66,2.49,25.83c1.25,1.74,3.44,4.35,5.2,5.34c-0.42,3.49-1.67,4.79-1.77,10.24c-2.61-0.87-8.33-7.84-9.9-10.35c-10.2-16.23-1.15-29.09-6.45-43.7c-0.83-2.4-2.29-5.23-3.86-6.32c-0.52,0.44-3.23,3.49-3.54,4.03c0.73,1.2,1.15,1.41,1.87,2.94c0.52,1.09,0.94,2.5,1.25,3.7c0.62,2.84,0.83,6.1,0.62,9.04c-0.42,6.22-0.94,12.53,0.1,18.64c0.83,5.45,2.81,10.24,5.2,14.27c2.51,3.93,5.73,7.74,8.96,10.35c1.67,1.53,3.44,2.84,5.52,4.03c2.49,1.52,0.73,1.64,3.86,5.99c6.04,8.72,16.55,12.21,26.13,7.08c2.29-1.2,3.75-2.5,5.52-3.93c1.15-0.87,3.96-3.93,4.58-5.23c-0.2-0.44-3.33-3.05-3.96-3.28c-1.87,1.74-3.23,3.59-5.42,5.34c-4.68,3.7-10.2,5.23-15.83,2.5c-2.19-1.2-4.8-3.28-5.94-4.9c2.19,0,3.44,0.65,6.87,0.21c3.96-0.55,7.6-2.08,10.62-4.35c1.25-0.99,3.33-2.73,3.96-3.7c-0.2-0.44-3.23-3.26-3.65-3.49c-2.71,1.85-4.06,3.93-8.86,5.34c-3.44,0.99-9.06,0.87-11.97-0.88c-1.04-1.85,0.1-8.93,0.94-10.78c3.13,0.23,4.16,1.64,9.26,0.99c2.91-0.44,5.62-1.41,7.91-2.61c6.97-4.03,11.55-10.78,14.16-18.52c0.62-1.74,2.49-6.98,1.46-8.83c-1.36-2.29-4.17-2.08-6.35-4.37c-2.09-2.08-2.71-4.79-2.09-8.61c0.73,0.33,1.25,1.09,2.09,1.53c0.83-0.55,2.71-3.81,3.02-4.46c-0.93-1.53-3.23-2.18-4.48-6.64c-2.71-9.37,5.83-17.32,15.31-17.32c11.67,0,20.1,11.77,13.64,20.92c-0.94,1.2-2.39,2.29-2.81,3.05c0.73,1.52,2.19,3.16,2.71,4.46c0.83-0.21,1.77-1.09,2.19-1.53c1.36,1.96-0.1,6.76-1.67,8.51c-4.58,4.79-9.48,0.32-5.2,13.08c1.04,2.84,2.19,5.23,3.54,7.63c4.06,7.08,10.31,12.53,18.54,13.73c5.31,0.65,6.25-0.76,9.38-0.99c0.42,0.99,0.94,3.7,1.04,4.9c0.1,0.99,0.2,1.96,0.2,2.94c0,0.65,0.2,2.4-0.32,2.94c-1.04,0.76-3.96,1.3-5.52,1.53c-4.06,0.33-7.91-0.87-11.25-2.84c-1.46-0.88-2.81-2.18-4.06-3.16c-0.42,0.21-3.44,3.05-3.65,3.49c1.67,2.5,5.73,5.13,8.65,6.43c2.81,1.3,6.25,1.85,9.48,1.74c1.04,0,2.39-0.33,3.33-0.33c-1.15,1.64-3.64,3.7-5.83,4.79c-7.07,3.59-13.54,0.21-18.64-4.9c-0.94-0.87-1.87-1.96-2.71-2.84c-0.62,0.21-1.56,1.09-2.09,1.53c-0.62,0.55-1.46,1.09-1.87,1.74c0.62,1.3,3.44,4.25,4.48,5.13c6.04,5.01,12.71,8.49,21.03,5.34c5.62-2.18,10.31-6.43,12.6-11.56c0.73-1.64,0.42-1.85,1.97-2.84c9.26-5.45,17.49-15.47,19.68-28.67c1.87-11.44-2.39-24.74,2.71-32.81c0.42-0.65,0.84-0.87,1.15-1.52c-0.2-0.44-3.02-3.59-3.54-4.03c-3.44,2.18-5.31,10.47-5.62,14.71c-0.83,11.77,3.64,21.9-4.68,35.19c-1.25,2.08-2.91,4.03-4.38,5.67c-0.73,0.87-4.27,4.35-5.52,4.79c-0.1-5.45-1.35-6.75-1.77-10.24c3.86-2.29,7.19-8.07,8.54-12.53c3.54-11.98-3.54-23.65-4.58-36.18c-0.31-3.28,0.1-6.64,1.25-9.16c1.04-2.29,2.91-5.01,4.8-5.89c-0.1-0.76-1.97-4.25-2.49-4.9c-3.54,0.87-7.39,8.07-8.44,12.21c-3.02,12.64,4.9,24.85,5.1,36.18c0.1,3.49-0.73,6.22-1.87,8.83c-0.84,1.96-3.02,5.34-4.48,5.99c-2.09-5.99-5.52-10.89-5.62-18.75c0-3.93,0.73-4.14,1.25-7.19l-4.78-2.29c-2.09,6.54-2.61,10.03-0.84,16.9c1.15,5.01,5,12.97,5.31,14.27c-10.41,3.16-18.02-3.59-22.18-11.88c-0.83-1.74-3.33-6.76-3.54-8.61c2.29-1.74,3.02-1.09,5.73-4.25c3.65-4.37,3.86-11.01,1.98-16.23c-1.15-3.05,0.83-2.61,0.94-8.39c0-11.44-10.1-19.84-21.25-19.84c-13.64,0-24.99,12.86-19.99,26.15c0.62,1.64-2.19,4.79-1.46,10.9c0.52,4.46,2.39,7.52,5.62,9.8C65.27,75.53,66.62,75.97,67.44,76.62";
</script>
<script>
(function(){
  var svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160"><ellipse cx="80" cy="80" rx="80" ry="77.95" fill="#191919"/><path fill="#F4F2F2" fill-rule="evenodd" clip-rule="evenodd" d="' + window.NEXUS_LOGO_PATH + '"/></svg>';
  var l = document.createElement('link');
  l.rel = 'icon'; l.type = 'image/svg+xml';
  l.href = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svg);
  document.head.appendChild(l);
})();
</script>
<script>
(function(){
  window.nexusErrBanner = function(text){
    var b = document.getElementById('nexus-err');
    if (!b){
      b = document.createElement('div');
      b.id = 'nexus-err';
      b.style.cssText = 'position:fixed;left:12px;right:12px;bottom:12px;z-index:9999;background:#241109;border:1px solid #e06a4e;color:#f3d9cf;padding:12px 16px;border-radius:12px;font:13px/1.5 Inter,system-ui,sans-serif;max-height:38vh;overflow:auto;white-space:pre-wrap;box-shadow:0 12px 30px rgba(0,0,0,.5)';
      document.body.appendChild(b);
    }
    b.textContent = 'Техническая ошибка (не игровая): ' + text;
  };
  window.addEventListener('error', function(e){ if (e && e.message) window.nexusErrBanner(e.message); });
  window.addEventListener('unhandledrejection', function(e){ window.nexusErrBanner(String(e && e.reason ? e.reason : e)); });
})();
</script>
<style>
:root{
  --bg:#0a0b08; --panel:#111310; --panel2:#0e100c; --card:#171912; --card2:#1c1f16;
  --line:#252820; --line2:#32362a;
  --text:#eff1e6; --muted:#a3a894; --dim:#6f7462;
  --acc:#cdf138; --acc-dim:#8fb51c; --warn:#e8b44a; --bad:#e06a4e; --okg:#9fd53a;
  --r:18px; --rc:14px;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--bg);color:var(--text);font-family:'Inter',system-ui,sans-serif;font-size:15px;line-height:1.55;-webkit-font-smoothing:antialiased;overflow-x:hidden}
::selection{background:var(--acc);color:#101204}
h1,h2,h3,.disp{font-family:'Inter Tight','Inter',sans-serif;text-transform:uppercase;letter-spacing:.01em;line-height:1.08}
button{font-family:inherit;color:inherit;background:none;border:none;cursor:pointer}
a{color:inherit}
.mono{font-family:'JetBrains Mono',monospace}
.lbl{font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:var(--dim)}
.wrap{max-width:1180px;margin:0 auto;padding:0 20px}
.btn{display:inline-flex;align-items:center;gap:9px;border-radius:999px;padding:13px 24px;font-size:14px;font-weight:700;letter-spacing:.02em;transition:.18s;border:1px solid transparent;white-space:nowrap}
.btn-acc{background:var(--acc);color:#0f1206}
.btn-acc:hover{filter:brightness(1.07)}
.btn-acc:active{transform:translateY(1px)}
.btn-ghost{border-color:var(--line2);color:var(--text)}
.btn-ghost:hover{border-color:var(--acc-dim);color:var(--acc)}
.btn-sm{padding:8px 16px;font-size:13px}
.btn:disabled{opacity:.4;cursor:not-allowed;filter:none}
.btn:focus-visible,button:focus-visible{outline:2px solid var(--acc);outline-offset:2px}
.chip{display:inline-flex;align-items:center;gap:7px;background:#181b12;border:1px solid var(--line);border-radius:999px;padding:5px 13px;font-size:11px;font-weight:600;letter-spacing:.09em;text-transform:uppercase;color:var(--muted)}
.chip .dot{width:6px;height:6px;border-radius:50%;background:var(--acc);flex:none}
.chip.acc{color:var(--acc);border-color:#39411f}
.chip.warn{color:var(--warn);border-color:#4a3c1c}
.chip.bad{color:var(--bad);border-color:#4c2418}
.chip.ok{color:var(--okg);border-color:#33471c}
.hdr{position:sticky;top:0;z-index:90;background:rgba(10,11,8,.88);backdrop-filter:blur(10px);border-bottom:1px solid var(--line)}
.hdr-in{display:flex;align-items:center;gap:18px;height:62px}
.logo{display:flex;align-items:center;gap:11px;text-decoration:none;color:var(--text)}
.logo-t{font-family:'Unbounded','Inter Tight',sans-serif;font-weight:700;font-size:14.5px;letter-spacing:.1em;line-height:1;color:var(--text)}
.logo-t small{display:block;font-family:'Inter';font-weight:600;font-size:8px;letter-spacing:.3em;color:var(--muted);margin-top:4px}
.steps{display:flex;gap:4px;margin:0 auto;overflow:hidden}
.step{display:flex;align-items:center;gap:6px;font-size:10.5px;letter-spacing:.06em;text-transform:uppercase;color:var(--dim);padding:6px 9px;white-space:nowrap}
.step i{width:6px;height:6px;border-radius:50%;background:#33362a;flex:none}
.step.done{color:var(--muted)}.step.done i{background:var(--acc-dim)}
.step.cur{color:var(--acc)}.step.cur i{background:var(--acc)}
.hdr-r{margin-left:auto;display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.cap{background:var(--card);border:1px solid var(--line);border-radius:999px;padding:8px 15px;font-size:13px;font-weight:700}
.cap em{font-style:normal;color:var(--acc);font-size:11px}
.capval-anim{display:inline-block;transition:color .3s ease}
.capval-anim.up{color:var(--acc)}
.capval-anim.down{color:var(--bad)}
.step-m{display:none}
main{padding:26px 0 60px}
.panel{background:var(--panel);border:1px solid #1e2118;border-radius:var(--r);padding:30px 32px}
.stage-head{margin-bottom:24px}
.stage-head .chip-row{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:14px}
.stage-head h2{font-size:clamp(21px,3.4vw,32px);font-weight:800}
.stage-head .sub{color:var(--muted);max-width:760px;margin-top:10px;font-size:14.5px}
.stage-foot{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-top:26px;flex-wrap:wrap}
.hint{color:var(--dim);font-size:12.5px;max-width:520px}
.anim{animation:fadeUp .5s ease both}
@keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}
.errpre{background:#120d0a;border:1px solid #4c2418;border-radius:10px;padding:12px;font:11px/1.5 'JetBrains Mono',monospace;color:#e0a18e;overflow:auto;max-height:220px;white-space:pre-wrap;margin-top:10px}
.mentor{display:flex;gap:12px;margin:0 0 18px;align-items:flex-start}
.mentor-ava{width:48px;height:48px;border-radius:50%;background:#14170d;border:1px solid #2c311e;display:flex;align-items:center;justify-content:center;flex:none;animation:float 4.5s ease-in-out infinite}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-4px)}}
.mentor-bubble{background:#14170d;border:1px solid #2c311e;border-left:3px solid var(--acc);border-radius:12px;padding:10px 14px;font-size:13.5px;color:var(--muted);max-width:720px}
.mentor-x{display:block;margin-top:6px;font-size:11px;color:var(--dim);text-decoration:underline}
.mentor-x:hover{color:var(--acc)}
.tips-fab{position:fixed;left:14px;bottom:14px;z-index:130;background:#171a10}
.term{border-bottom:1px dashed var(--acc-dim);cursor:pointer;color:var(--text)}
.term-pop{position:absolute;bottom:calc(100% + 7px);left:50%;transform:translateX(-50%);background:#171a10;border:1px solid var(--line2);padding:9px 12px;font-size:12px;color:var(--muted);width:250px;z-index:80;border-radius:9px;box-shadow:0 10px 26px rgba(0,0,0,.5);text-transform:none}
.term-pop b{color:var(--acc);display:block;margin-bottom:3px;font-size:10.5px;text-transform:uppercase;letter-spacing:.08em}
.hero{display:grid;grid-template-columns:1.05fr .95fr;gap:34px;align-items:center;padding:44px 0 10px}
.hero .eyebrow{color:var(--dim);font-size:11px;letter-spacing:.24em;text-transform:uppercase;font-weight:600;margin:16px 0 14px}
.hero h1{font-size:clamp(30px,5.4vw,58px);font-weight:900}
.hero .lead{color:var(--muted);max-width:520px;margin-top:16px;font-size:15.5px}
.hero .chips{display:flex;gap:8px;flex-wrap:wrap}
.hero-btns{display:flex;gap:12px;margin-top:26px;flex-wrap:wrap}
.hero-note{margin-top:14px;color:var(--dim);font-size:12.5px}
.seed-in{background:#14170d;border:1px solid var(--line2);border-radius:9px;color:var(--text);padding:7px 11px;font:12.5px 'JetBrains Mono';width:130px}
.canvas-card{border:1px solid var(--line);border-radius:var(--r);background:var(--panel2);overflow:hidden}
.canvas-card .cc-top{display:flex;justify-content:space-between;align-items:center;padding:12px 16px;border-bottom:1px solid var(--line)}
.cc-tag{font-size:10px;letter-spacing:.18em;color:var(--muted);text-transform:uppercase;font-weight:700}
.net{display:block;width:100%;height:290px}
.legend{display:flex;gap:14px;padding:10px 16px;border-top:1px solid var(--line);font-size:11px;color:var(--muted);flex-wrap:wrap}
.legend i{width:7px;height:7px;border-radius:2px;display:inline-block;margin-right:6px}
.mini-stats{display:grid;grid-template-columns:repeat(4,1fr);border:1px solid var(--line);border-radius:var(--r);margin-top:14px;overflow:hidden;background:var(--panel2)}
.ms{padding:14px 16px;border-right:1px solid var(--line)}
.ms:last-child{border-right:none}
.ms b{display:block;font-family:'JetBrains Mono';font-size:20px;color:var(--acc);font-weight:700}
.ms span{font-size:11px;color:var(--dim);text-transform:uppercase;letter-spacing:.05em}
.disc-strip{display:flex;gap:12px;align-items:flex-start;border:1px solid #3a2c14;background:#15130b;border-radius:var(--rc);padding:14px 18px;margin-top:26px;color:#cbb98a;font-size:12.5px}
.disc-strip svg{flex:none;color:var(--warn);margin-top:1px}
.cards3{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
.card{background:var(--card);border:1px solid var(--line);border-radius:var(--rc);padding:18px;display:flex;flex-direction:column;gap:10px;transition:.18s;position:relative;text-align:left}
.card.click{cursor:pointer}
.card.click:hover{border-color:var(--line2);transform:translateY(-2px)}
.card.sel{border-color:var(--acc-dim)}
.card.sel::after{content:'✓';position:absolute;top:12px;right:12px;width:22px;height:22px;border-radius:50%;background:var(--acc);color:#0f1206;font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center}
.icon-tile{width:42px;height:42px;border-radius:11px;background:#1d2013;border:1px solid #2c311e;display:flex;align-items:center;justify-content:center;color:var(--acc)}
.card h3{font-size:15.5px;font-weight:800}
.card .desc{color:var(--muted);font-size:13px;flex:1}
.meta{display:grid;grid-template-columns:1fr 1fr;gap:6px 14px;font-size:12px;border-top:1px solid var(--line);padding-top:11px}
.meta div{display:flex;justify-content:space-between;gap:8px}
.meta span{color:var(--dim)}.meta b{font-weight:600;color:var(--text)}
.rdot{display:inline-block;width:7px;height:7px;border-radius:50%;margin-right:5px}
.card-foot{display:flex;justify-content:space-between;align-items:center;gap:8px;margin-top:2px}
.mini-bar{height:3px;border-radius:99px;background:#262a1c;flex:1;overflow:hidden;max-width:90px}
.mini-bar i{display:block;height:100%;background:var(--acc-dim)}
.strategy-b{list-style:none;display:flex;flex-direction:column;gap:7px;margin-top:4px}
.strategy-b li{display:flex;gap:9px;font-size:12.5px;color:var(--muted)}
.strategy-b svg{flex:none;color:var(--acc);margin-top:2px}
.map-panel{border:1px solid var(--line);border-radius:var(--rc);background:var(--panel2);position:relative;height:230px;margin-bottom:16px;overflow:hidden;background-image:radial-gradient(#21251a 1px,transparent 1px);background-size:22px 22px}
.map-panel svg{position:absolute;inset:0;width:100%;height:100%}
.pin{position:absolute;transform:translate(-50%,-50%);display:flex;flex-direction:column;align-items:center;gap:5px;z-index:2}
.pin i{width:13px;height:13px;border-radius:50%;background:#3a3e2f;border:2px solid #565b45;transition:.18s}
.pin.on i{background:var(--acc);border-color:var(--acc);box-shadow:0 0 0 4px rgba(205,241,56,.15)}
.pin span{font-size:9.5px;letter-spacing:.04em;color:var(--dim);text-transform:uppercase;font-weight:600;white-space:nowrap}
.pin.on span{color:var(--acc)}
.pin:hover i{transform:scale(1.25)}
.hub-ic2{position:absolute;left:50%;top:52%;transform:translate(-50%,-50%) rotate(45deg);width:16px;height:16px;background:var(--acc);border-radius:4px;z-index:1;opacity:.9}
.map-note{position:absolute;bottom:10px;right:14px;font-size:10px;color:var(--dim);letter-spacing:.1em;text-transform:uppercase}
.memo{border:1px dashed #3a4128;border-radius:var(--rc);padding:14px 16px;margin-bottom:16px;background:#12140c}
.memo-head{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.memo-head b{font-size:13.5px;color:var(--text)}
.memo-body{margin-top:10px;color:var(--muted);font-size:13px;border-top:1px dashed #2c311e;padding-top:10px;display:flex;flex-direction:column;gap:8px}
.memo.skip{opacity:.45}
.forecast{background:#14170e;border:1px solid #22261a;border-radius:11px;padding:12px 15px;margin-bottom:14px}
.fc-head{display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;align-items:center}
.plain{display:flex;gap:9px;align-items:flex-start;border:1px solid #39411f;background:#15180d;border-radius:10px;padding:10px 13px;margin-top:12px;font-size:13px;color:var(--muted)}
.plain svg{flex:none;color:var(--acc);margin-top:2px}
.plain b{color:var(--acc)}
.trial-hint{display:flex;gap:8px;align-items:flex-start;border:1px dashed var(--acc-dim);background:#12140c;border-radius:10px;padding:9px 12px;font-size:12.5px;color:var(--acc);margin:10px 0}
.trial-hint svg{flex:none;margin-top:2px}
.legend-row{display:flex;gap:14px;flex-wrap:wrap;margin:10px 0}
.legend-it{display:inline-flex;align-items:center;gap:6px;font-size:12px;color:var(--muted)}
.legend-it i{width:9px;height:9px;border-radius:50%;display:inline-block;flex:none}
.legend-it.sm{font-size:11px}
table.tbl{width:100%;border-collapse:collapse;font-size:13px}
.tbl th{text-align:left;font-size:10.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--dim);font-weight:600;padding:8px 10px;border-bottom:1px solid var(--line)}
.tbl td{padding:10px;border-bottom:1px solid #1d2016}
.tbl tr.hl td{background:#191c11}
.an-grid{display:grid;grid-template-columns:340px 1fr;gap:16px;align-items:start}
.pick{display:flex;flex-direction:column;gap:8px}
.pick-b{display:flex;justify-content:space-between;align-items:center;gap:10px;background:var(--card);border:1px solid var(--line);border-radius:11px;padding:10px 13px;font-size:13px;text-align:left;transition:.15s;width:100%}
.pick-b:hover{border-color:var(--line2)}
.pick-b.on{border-color:var(--acc-dim);background:#191c10}
.pick-b .sc{font-family:'JetBrains Mono';font-weight:700;color:var(--acc);font-size:14px}
.tools{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:14px}
.tool{display:flex;flex-direction:column;gap:7px;align-items:flex-start;background:var(--card);border:1px solid var(--line);border-radius:11px;padding:12px;font-size:12.5px;font-weight:600;transition:.15s;text-align:left}
.tool:hover{border-color:var(--acc-dim)}
.tool.used{border-color:#39411f}
.tool .used-t{font-size:9.5px;color:var(--acc-dim);letter-spacing:.1em;text-transform:uppercase}
.an-out{background:var(--card);border:1px solid var(--line);border-radius:var(--rc);padding:20px;min-height:420px}
.factor{display:grid;grid-template-columns:1fr 52px 44px;gap:10px;align-items:center;font-size:12.5px;padding:7px 0;border-bottom:1px solid #202417}
.factor .fb{height:4px;border-radius:99px;background:#262a1c;overflow:hidden}
.factor .fb i{display:block;height:100%;background:var(--acc)}
.factor span{color:var(--muted)}.factor em{font-style:normal;color:var(--dim);font-size:11px;text-align:right}
.score-big{display:flex;align-items:baseline;gap:10px;margin:14px 0 4px}
.score-big b{font-family:'JetBrains Mono';font-size:42px;color:var(--acc);font-weight:700}
.score-big span{color:var(--dim);font-size:12px;text-transform:uppercase;letter-spacing:.1em}
.fact{display:flex;gap:9px;font-size:12.5px;color:var(--muted);background:#151810;border:1px solid #22261a;border-radius:10px;padding:9px 12px}
.fact svg{flex:none;color:var(--acc);margin-top:2px}
.bld-grid{display:grid;grid-template-columns:1.15fr .85fr;gap:16px;align-items:start}
.srow{background:var(--card);border:1px solid var(--line);border-radius:12px;padding:13px 15px;margin-bottom:10px}
.srow-top{display:flex;justify-content:space-between;align-items:center;gap:10px;margin-bottom:6px}
.srow-top b{font-size:13.5px}
.srow-top .val{font-family:'JetBrains Mono';font-weight:700;color:var(--acc);font-size:13.5px}
.qbtns{display:flex;gap:6px}
.qbtn{font-size:10.5px;border:1px solid var(--line2);border-radius:99px;padding:3px 10px;color:var(--muted);letter-spacing:.05em}
.qbtn:hover{border-color:var(--acc-dim);color:var(--acc)}
.qbtn:disabled{opacity:.4;cursor:not-allowed}
input[type=range]{-webkit-appearance:none;appearance:none;width:100%;height:22px;background:transparent;cursor:pointer}
input[type=range]::-webkit-slider-runnable-track{height:4px;border-radius:99px;background:linear-gradient(90deg,var(--acc) var(--fill,0%),#272b1e var(--fill,0%))}
input[type=range]::-webkit-slider-thumb{-webkit-appearance:none;width:17px;height:17px;border-radius:50%;background:var(--acc);border:3px solid #0b0c09;margin-top:-6.5px;box-shadow:0 0 0 1px var(--acc-dim)}
input[type=range]::-moz-range-track{height:4px;border-radius:99px;background:#272b1e}
input[type=range]::-moz-range-progress{height:4px;border-radius:99px;background:var(--acc)}
input[type=range]::-moz-range-thumb{width:15px;height:15px;border-radius:50%;background:var(--acc);border:none}
.remaining{display:flex;justify-content:space-between;align-items:baseline;background:#14170d;border:1px solid #2c311a;border-radius:12px;padding:13px 16px;margin-bottom:14px}
.remaining b{font-family:'JetBrains Mono';font-size:21px;color:var(--acc)}
.remaining span{font-size:11px;color:var(--dim);text-transform:uppercase;letter-spacing:.08em}
.warn-box{display:flex;gap:10px;font-size:12.5px;border-radius:10px;padding:10px 13px;margin-top:9px;border:1px solid}
.warn-box svg{flex:none;margin-top:2px}
.warn-box.w{color:#d9b168;border-color:#453514;background:#161207}
.warn-box.g{color:#b5d67e;border-color:#33471c;background:#131608}
.warn-box.r{color:#e08a72;border-color:#4c2418;background:#170d09}
.scen3{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:14px}
.scen{background:var(--card);border:1px solid var(--line);border-radius:11px;padding:12px}
.scen span{font-size:10.5px;color:var(--dim);text-transform:uppercase;letter-spacing:.08em}
.scen b{display:block;font-family:'JetBrains Mono';font-size:17px;margin:5px 0 2px}
.scen em{font-style:normal;font-size:11.5px;font-family:'JetBrains Mono'}
.donut-l{display:flex;flex-direction:column;gap:6px;margin-top:12px;font-size:12px}
.donut-l div{display:flex;align-items:center;gap:8px;color:var(--muted)}
.donut-l i{width:9px;height:9px;border-radius:3px;flex:none}
.donut-l b{margin-left:auto;font-family:'JetBrains Mono';font-weight:500;color:var(--text)}
.donut-seg{transition:stroke-dasharray .6s ease, stroke-dashoffset .6s ease}
.gauge{margin-top:13px}
.gauge-top{display:flex;justify-content:space-between;font-size:12px;color:var(--muted);margin-bottom:6px}
.gauge-top .gauge-v{color:var(--text);font-weight:700;font-size:12.5px}
.gauge-track{position:relative;height:6px;border-radius:99px;background:#272b1e;overflow:visible}
.gauge-track.grad{background:linear-gradient(90deg,#7cb32e,#cdf138,#e8b44a,#e06a4e)}
.gauge-mark{position:absolute;top:-4px;width:3px;height:14px;background:#fff;border-radius:2px;transform:translateX(-50%);transition:left .4s}
.pipe{display:grid;grid-template-columns:repeat(6,1fr);gap:8px;margin:20px 0 6px}
.pnode{display:flex;flex-direction:column;align-items:center;gap:9px;text-align:center}
.pnode i{width:34px;height:34px;border-radius:50%;border:2px solid #2f3324;display:flex;align-items:center;justify-content:center;font-family:'JetBrains Mono';font-size:12px;color:var(--dim);background:var(--card);transition:.3s}
.pnode span{font-size:10px;color:var(--dim);text-transform:uppercase;letter-spacing:.04em;line-height:1.3}
.pnode.done i{background:var(--acc);border-color:var(--acc);color:#101204}
.pnode.done span{color:var(--muted)}
.pnode.act i{border-color:var(--acc);color:var(--acc);animation:pulse 1.4s infinite}
.pnode.act span{color:var(--acc)}
@keyframes pulse{0%{box-shadow:0 0 0 0 rgba(205,241,56,.35)}70%{box-shadow:0 0 0 11px rgba(205,241,56,0)}100%{box-shadow:0 0 0 0 rgba(205,241,56,0)}}
.pipe-line{height:1px;background:var(--line);grid-column:1/-1;margin:-4px 0}
.pipe-info{color:var(--muted);font-size:13.5px;background:#14170e;border:1px solid #22261a;border-radius:11px;padding:12px 15px;margin-top:16px;min-height:46px}
.pstatus{display:flex;flex-direction:column;gap:8px;margin-top:14px}
.pstatus-row{display:flex;align-items:center;gap:10px;background:var(--card);border:1px solid var(--line);border-radius:11px;padding:10px 14px;font-size:13px;flex-wrap:wrap}
.pstatus-row b{font-weight:600}
.pstatus-row .grow{flex:1}
.faq{margin-top:26px;border-top:1px solid var(--line)}
.faq-it{border-bottom:1px solid var(--line)}
.faq-q{width:100%;display:flex;justify-content:space-between;align-items:center;gap:14px;padding:15px 4px;font-size:14px;font-weight:600;text-align:left}
.faq-q svg{flex:none;color:var(--acc);transition:.25s}
.faq-q.open svg{transform:rotate(45deg)}
.faq-a{color:var(--muted);font-size:13.5px;padding:0 4px 16px;max-width:720px}
.hub{display:flex;flex-direction:column;gap:10px}
.hub-row{display:flex;align-items:center;gap:14px;background:var(--card);border:1px solid var(--line);border-radius:12px;padding:13px 15px;flex-wrap:wrap}
.hub-ic{width:40px;height:40px;border-radius:10px;background:#1d2013;border:1px solid #2c311e;display:flex;align-items:center;justify-content:center;color:var(--acc);flex:none}
.hub-info{flex:1;min-width:200px}
.hub-info b{display:block;font-size:14px}
.hub-info span{font-size:12px;color:var(--muted)}
.hub-ctl{display:flex;align-items:center;gap:10px}
.hub-pips i{width:10px;height:10px;border-radius:50%;background:#2f3324;display:inline-block;margin-right:4px}
.hub-pips i.on{background:var(--acc)}
.hub-lvl{font-family:'JetBrains Mono';font-size:12px;color:var(--muted);min-width:60px;text-align:center}
.hub-sum{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px}
.rounds{display:flex;gap:7px;flex-wrap:wrap;margin-bottom:18px}
.rnd{width:34px;height:34px;border-radius:10px;border:1px solid var(--line);display:flex;align-items:center;justify-content:center;font-family:'JetBrains Mono';font-size:13px;color:var(--dim);background:var(--card)}
.rnd.done{border-color:#39411f;color:var(--acc-dim)}
.rnd.cur{border-color:var(--acc);color:var(--acc);background:#181b0e}
.ev-card{background:var(--card);border:1px solid var(--line);border-radius:var(--rc);padding:22px}
.ev-card h3{font-size:19px;font-weight:800;text-transform:uppercase;margin:10px 0 8px}
.ev-card .desc{color:var(--muted);font-size:14px;max-width:720px}
.opts{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:18px}
.opt{background:var(--panel2);border:1px solid var(--line);border-radius:12px;padding:15px;display:flex;flex-direction:column;gap:10px;text-align:left;transition:.15s;align-items:flex-start}
.opt:hover:not(:disabled){border-color:var(--acc-dim);transform:translateY(-2px)}
.opt:disabled{cursor:default;opacity:.45}
.opt.chosen{opacity:1;border-color:var(--acc)}
.opt b{font-size:13.5px;line-height:1.35}
.opt .tags{display:flex;flex-wrap:wrap;gap:5px}
.opt .tags span{font-size:10.5px;font-family:'JetBrains Mono';border:1px solid #2c311e;border-radius:99px;padding:2px 8px;color:var(--muted)}
.opt .ins-t{font-size:10px;color:var(--acc);letter-spacing:.06em;text-transform:uppercase}
.res-panel{background:#15180d;border:1px solid #39411f;border-radius:var(--rc);padding:20px;margin-top:16px;animation:fadeUp .4s ease both}
.res-panel h4{font-size:14px;text-transform:uppercase;letter-spacing:.06em;margin-bottom:10px}
.res-row{display:flex;justify-content:space-between;gap:12px;font-size:13px;padding:7px 0;border-bottom:1px solid #22261a;color:var(--muted)}
.res-row b{font-family:'JetBrains Mono';font-weight:700;color:var(--text)}
.buffet-row{display:flex;justify-content:space-between;gap:10px;font-size:13px;padding:9px 0;border-bottom:1px solid #22261a;color:var(--muted);flex-wrap:wrap}
.buffet-row b{font-family:'JetBrains Mono';color:var(--text)}
.res-total{display:flex;justify-content:space-between;align-items:baseline;padding-top:12px}
.res-total b{font-family:'JetBrains Mono';font-size:22px;color:var(--acc)}
.res-note{font-size:12.5px;color:var(--dim);margin-top:10px}
.res-grid{display:grid;grid-template-columns:380px 1fr;gap:16px;align-items:stretch}
.tier-card{background:var(--card);border:1px solid var(--line);border-radius:var(--rc);padding:24px;display:flex;flex-direction:column;align-items:center;text-align:center;gap:6px}
.tier-card .tier{font-size:clamp(19px,2.6vw,26px);font-weight:900;color:var(--acc);text-transform:uppercase;line-height:1.15}
.tier-card p{color:var(--muted);font-size:13px}
.dial-wrap{position:relative;width:150px;height:150px}
.dial-c{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center}
.dial-c b{font-family:'JetBrains Mono';font-size:30px;color:var(--acc)}
.dial-c span{font-size:9.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--dim)}
.chart-card{background:var(--card);border:1px solid var(--line);border-radius:var(--rc);padding:20px}
.chart-card .cc-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;gap:10px;flex-wrap:wrap}
.stats6{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:16px}
.stat{background:var(--card);border:1px solid var(--line);border-radius:12px;padding:15px 17px}
.stat span{font-size:10.5px;color:var(--dim);text-transform:uppercase;letter-spacing:.09em}
.stat b{display:block;font-family:'JetBrains Mono';font-size:21px;margin-top:5px}
.stat em{font-style:normal;font-size:11.5px;color:var(--muted);font-family:'JetBrains Mono'}
.qbars{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:16px}
.qbar .gauge-top{font-size:12.5px}
.vs-grid{display:grid;grid-template-columns:1fr auto 1fr;gap:14px;align-items:center;margin:6px 0 2px}
.vs-num b{font-family:'JetBrains Mono';font-size:24px}
.vs-num span{display:block;font-size:11px;color:var(--dim);text-transform:uppercase;letter-spacing:.06em;margin-top:3px}
.vs-mid{font-family:'Inter Tight';font-weight:800;color:var(--dim);font-size:18px}
.buffet-verdict{margin-top:12px;font-size:13.5px;color:var(--muted)}
.buffet-verdict i{display:block;margin-top:6px;color:var(--dim);font-size:12.5px}
.ovl{position:fixed;inset:0;background:rgba(5,6,3,.74);backdrop-filter:blur(5px);z-index:150;display:flex;align-items:center;justify-content:center;padding:18px;animation:fadeUp .2s ease}
.dlg{background:var(--panel);border:1px solid var(--line2);border-radius:20px;max-width:820px;width:100%;max-height:88vh;overflow:auto;padding:26px 28px;position:relative}
.dlg h3{font-size:19px;text-transform:uppercase;margin-bottom:14px;padding-right:40px}
.dlg-x{position:absolute;top:18px;right:18px;width:34px;height:34px;border-radius:50%;border:1px solid var(--line2);display:flex;align-items:center;justify-content:center;color:var(--muted)}
.dlg-x:hover{color:var(--acc);border-color:var(--acc-dim)}
.toast{position:fixed;left:50%;bottom:24px;transform:translateX(-50%);background:#171a10;border:1px solid var(--acc-dim);border-radius:12px;padding:11px 18px;font-size:13px;z-index:220;animation:fadeUp .25s ease;box-shadow:0 10px 30px rgba(0,0,0,.5);max-width:min(92vw,480px);text-align:center;display:flex;gap:8px;align-items:center}
.toast.ach{border-color:var(--warn);color:#ecdfb0}
footer{border-top:1px solid var(--line);background:var(--panel2);margin-top:20px}
.ft{display:grid;grid-template-columns:1.3fr 1fr 1fr;gap:30px;padding:34px 0 26px}
.ft h5{font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:var(--dim);margin-bottom:12px}
.ft p{color:var(--muted);font-size:12.5px;max-width:340px}
.ft ul{list-style:none;display:flex;flex-direction:column;gap:8px;font-size:13px}
.ft li{color:var(--muted)}
.ft a,.ft button{color:var(--muted);text-decoration:none;font-size:13px;text-align:left}
.ft a:hover,.ft button:hover{color:var(--acc)}
.pb{margin-bottom:10px}
.pb .pb-t{display:flex;justify-content:space-between;font-size:11px;color:var(--dim);margin-bottom:4px;text-transform:uppercase;letter-spacing:.06em}
.pb .bar{height:4px}
.ft-btm{border-top:1px solid var(--line);padding:14px 0;color:var(--dim);font-size:11.5px;display:flex;justify-content:space-between;gap:14px;flex-wrap:wrap}
.bar{height:5px;border-radius:99px;background:#252a1c;overflow:hidden}
.bar i{display:block;height:100%;background:var(--acc);border-radius:99px;transition:width .5s}
.det-grid{display:grid;grid-template-columns:250px 1fr;gap:16px;align-items:start}
.det-doc-b{display:flex;flex-direction:column;gap:6px;text-align:left;background:var(--card);border:1px solid var(--line);border-radius:11px;padding:11px 13px;width:100%;transition:.15s}
.det-doc-b:hover{border-color:var(--line2)}
.det-doc-b.on{border-color:var(--acc-dim);background:#191c10}
.det-doc-b b{font-size:13px;display:block}
.det-doc-b span{font-size:11px;color:var(--dim)}
.det-doc-b .fl{font-size:10px;color:var(--warn);font-family:'JetBrains Mono'}
.doc{background:var(--card);border:1px solid var(--line);border-radius:var(--rc);padding:20px}
.doc-head{display:flex;justify-content:space-between;align-items:baseline;gap:10px;flex-wrap:wrap;border-bottom:1px solid var(--line);padding-bottom:10px;margin-bottom:12px}
.doc-head b{font-size:15px}
.doc-head span{font-size:10.5px;color:var(--dim);text-transform:uppercase;letter-spacing:.08em}
.doc-row{display:flex;justify-content:space-between;gap:14px;padding:9px 10px;border-bottom:1px solid #1d2016;border-radius:7px;cursor:pointer;transition:.12s;align-items:baseline}
.doc-row:hover{background:#191c11}
.doc-row.flag{background:#1d2110;border:1px solid #4a3c1c}
.doc-row .k{color:var(--muted);font-size:13px}
.doc-row .v{font-family:'JetBrains Mono';font-size:12.5px;text-align:right;white-space:nowrap}
.doc-row .fm{flex:none;width:16px;height:16px;border-radius:5px;border:1.5px solid var(--line2);display:inline-flex;align-items:center;justify-content:center;font-size:10px;color:var(--acc)}
.doc-row.flag .fm{background:var(--warn);border-color:var(--warn);color:#101204}
.doc-note{font-size:11.5px;color:var(--dim);margin-top:10px}
.verdict-box{margin-top:16px;background:var(--card);border:1px solid var(--line);border-radius:var(--rc);padding:16px}
.vopt{display:block;width:100%;text-align:left;background:var(--panel2);border:1px solid var(--line);border-radius:10px;padding:10px 13px;font-size:13px;margin-bottom:8px;transition:.12s}
.vopt:hover{border-color:var(--acc-dim)}
.vopt.on{border-color:var(--acc);background:#191c10}
.det-brief{background:#12140c;border:1px dashed #3a4128;border-radius:var(--rc);padding:14px 16px;margin-bottom:14px;color:var(--muted);font-size:13.5px}
.det-res{display:flex;flex-direction:column;gap:8px;margin-top:8px}
.det-res .res-row b.hit{color:var(--acc)}
.det-res .res-row b.miss{color:var(--bad)}
.ins-chip{display:inline-flex;align-items:center;gap:6px;background:#181b0e;border:1px solid #39411f;border-radius:99px;padding:5px 12px;font-size:11.5px;color:var(--acc);font-weight:600}
@media(max-width:1020px){
  .steps{display:none}.step-m{display:block;color:var(--muted);font-size:11px;letter-spacing:.1em;text-transform:uppercase;margin:0 auto}
  .hero{grid-template-columns:1fr}
  .cards3{grid-template-columns:1fr 1fr}
  .an-grid,.bld-grid,.res-grid,.det-grid{grid-template-columns:1fr}
  .ft{grid-template-columns:1fr 1fr}
  .pipe{grid-template-columns:repeat(3,1fr);row-gap:18px}
  .pipe-line{display:none}
}
@media(max-width:680px){
  .panel{padding:20px 16px}
  .cards3,.opts,.scen3,.stats6,.qbars{grid-template-columns:1fr}
  .mini-stats{grid-template-columns:1fr 1fr}
  .ms:nth-child(2){border-right:none}
  .ms:nth-child(1),.ms:nth-child(2){border-bottom:1px solid var(--line)}
  .net{height:210px}
  .ft{grid-template-columns:1fr}
  .hdr-in{gap:10px}
  .cap{font-size:11.5px;padding:7px 11px}
  .logo-t{font-size:12.5px}
  .hdr .logo svg{width:30px;height:30px}
  .res-grid{gap:12px}
  .dlg{padding:20px 16px}
  .term-pop{width:200px}
  .det-grid{gap:10px}
}
</style>
</head>
<body>
<div id="root"></div>
<noscript><p style="padding:24px">Для работы игры необходимо включить JavaScript.</p></noscript>

<script type="text/plain" id="ts-src">
const {useState, useEffect, useRef} = React;

/* ================= ТИПЫ ================= */
type Phase = 'intro'|'strategy'|'catalog'|'analytics'|'invest'|'builder'|'pipeline'|'hub'|'trial'|'events'|'results';
type StrategyId = 'careful'|'balanced'|'innov';
type ToolId = 'analyze'|'compare'|'risks'|'scenario';
type MemoState = 'closed'|'open'|'skip';
type InsightId = 'fin'|'demand'|'sched'|'supplier'|'docs'|'liquid';
interface Metrics { fin:number; demand:number; docs:number; delay:number; data:number }
interface Project { id:string; name:string; industry:string; icon:string; desc:string; target:number; term:number; risk:number; transparency:number; readiness:number; ret:number; scenario:string; metrics:Metrics; risks:string[] }
interface Eff { capPct?:number; per100k?:number; reservePct?:number; risk?:number; delay?:number; transp?:number; quality?:number; rep?:number }
interface EvOpt { l:string; e:Eff; n:string; ins?:InsightId; guardRes?:number }
interface EvDef { id:string; cat:string; ind?:string[]; cond?:string; diff:1|2|3; w:number; t:string; d:string; o:EvOpt[] }
interface RoundCtx { reserve:number; ids:string[]; before:Record<string, number>; pct:Record<string, number>; allocs:Record<string, number> }
interface RoundLog { round:number; ev:EvDef; optI:number; applied:Eff; ao:Eff[]; ch:{k:string; v:string; bad:boolean}[]; drift:number; evDelta:number; total:number; per:{name:string; drift:number; ev:number}[]; guardNote?:string; insight:boolean; affectedNote?:string; ctx:RoundCtx; reply?:string }
interface Buffet { policy:'careful'|'aggress'; vals:Record<string, number>; riskExtra:number; total:number; choices:{round:number; label:string; total:number}[] }
interface DetDoc { id:string; title:string; tag:string; rows:{k:string; v:string; sus?:string; why?:string}[] }
interface DetCase { id:string; name:string; industry:string; diff:1|2|3; intro:string; docs:DetDoc[]; verdicts:{id:string; label:string}[]; truthId:string; explain:string; insight:InsightId }
interface FinalMetrics { total:number; finalV:number; growth:number; completed:number; fundedCount:number; wRisk:number; eff:number; quality:number; transp:number; rep:number; tier:{name:string; desc:string}; toolsUsed:number }

/* ================= ГЕНЕРАТОР СЛУЧАЙНОСТИ ================= */
let rng:()=>number = Math.random;
function mulberry32(a:number){
  return function(){
    a |= 0; a = a + 0x6D2B79F5 | 0;
    let t = Math.imul(a ^ a >>> 15, 1 | a);
    t = t + Math.imul(t ^ t >>> 7, 61 | t) ^ t;
    return ((t ^ t >>> 14) >>> 0) / 4294967296;
  };
}
function pickWeighted<T>(items:T[], weight:(x:T)=>number):T|null {
  if (!items.length) return null;
  let total = 0; items.forEach(i => total += Math.max(0.01, weight(i)));
  let r = rng()*total;
  for (const it of items){ r -= Math.max(0.01, weight(it)); if (r <= 0) return it; }
  return items[items.length-1];
}

/* ================= БАЗОВЫЕ ХЕЛПЕРЫ ФОРМАТИРОВАНИЯ =================
   Объявлены ДО данных и детективных фабрик: последние вызываются при
   инициализации модуля (DET_LIBRARY) и используют nf/fmt — иначе TDZ. */
const clamp = (v:number, a:number, b:number) => Math.max(a, Math.min(b, v));
const nf = new Intl.NumberFormat('ru-RU');
const fmt = (n:number) => nf.format(Math.round(n));
const fmtSign = (n:number) => (n >= 0 ? '+' : '−') + nf.format(Math.abs(Math.round(n)));
const fmtPct1 = (n:number) => (n >= 0 ? '+' : '−') + Math.abs(n).toFixed(1).replace('.', ',') + '%';
const fmtNum = (n:number) => (n > 0 ? '+' : '−') + String(Math.abs(n)).replace('.', ',');
const fmtShort = (n:number) => { const a = Math.abs(n); if (a >= 1e6) return (n/1e6).toFixed(1).replace('.', ',') + ' млн'; if (a >= 1e3) return nf.format(Math.round(n/1e3)) + ' тыс.'; return fmt(n); };
const riskBand = (r:number) => r <= 30 ? {label:'Низкий', c:'var(--acc)'} : r <= 45 ? {label:'Умеренный', c:'#b9d944'} : r <= 60 ? {label:'Повышенный', c:'var(--warn)'} : {label:'Высокий', c:'var(--bad)'};

/* ================= ДАННЫЕ ================= */
const TOTAL = 1000000;
const HUB_BUDGET = 100000;
const HUB_COST = 25000;
const HUB_MAX = 2;
const ROUNDS = 6;
const STAGES = ['Стратегия','Витрина','Аналитика','Расследование','Портфель','Токенизация','Хаб','Обучение','События','Итоги'];
const PHASE_IDX:Record<string, number> = {intro:-1, strategy:0, catalog:1, analytics:2, invest:3, builder:4, pipeline:5, hub:6, trial:7, events:8, results:9};
const INS_NAMES:Record<InsightId, string> = {
  fin:'Финансовая дисциплина', demand:'Проверка спроса', sched:'Контроль графика',
  supplier:'Резервный подрядчик', docs:'Документационный компас', liquid:'Ликвидный резерв',
};
const INS_DESC:Record<InsightId, string> = {
  fin:'Заметили расхождение смет — в финансовых кризисах доступны дополнительные варианты.',
  demand:'Вскрыли завышенный прогноз — при рыночных событиях доступны дополнительные варианты.',
  sched:'Нашли противоречия графика — при строительных событиях доступны дополнительные варианты.',
  supplier:'Раскрыли зависимость от подрядчика — при сбоях поставок доступен резервный подрядчик.',
  docs:'Выявили пробелы документов — при документационных событиях доступны дополнительные варианты.',
  liquid:'Нашли кассовый разрыв — при финансовых кризисах доступно управление резервом.',
};

const PROJECTS:Project[] = [
  {id:'solar', name:'Солнечная энергетика', industry:'Энергетика', icon:'sun', target:480000, term:36, risk:34, transparency:82, readiness:68, ret:16,
   desc:'Строительство солнечной электростанции мощностью 40 МВт в Южном регионе с продажей электроэнергии по долгосрочным контрактам.',
   scenario:'Базовый: ≈ 16% годовых (демо). Консервативный: ≈ 9%. Стресс: −5% при просадке тарифов.',
   metrics:{fin:78, demand:74, docs:82, delay:24, data:84},
   risks:['Погодная изменчивость выработки','Зависимость от тарифных решений','Сроки подключения к сетям']},
  {id:'wind', name:'Ветропарк', industry:'Энергетика', icon:'bolt', target:520000, term:30, risk:38, transparency:76, readiness:61, ret:18,
   desc:'Ветроэнергетический комплекс из 22 установок в степной зоне с двусторонними договорами поставки мощности.',
   scenario:'Базовый: ≈ 18% годовых (демо). Консервативный: ≈ 10%. Стресс: −7% при слабой ветрообстановке.',
   metrics:{fin:74, demand:72, docs:76, delay:32, data:78},
   risks:['Непредсказуемость ветрового режима','Лицензирование земельных участков','Логистика крупногабаритных секций']},
  {id:'resid', name:'Жилая инфраструктура', industry:'Недвижимость', icon:'home', target:620000, term:48, risk:28, transparency:88, readiness:74, ret:12,
   desc:'Комплексное развитие жилого квартала на 120 тыс. м²: три очереди строительства, встроенная коммерция и подземный паркинг.',
   scenario:'Базовый: ≈ 12% годовых (демо). Консервативный: ≈ 7%. Стресс: −4% при охлаждении рынка жилья.',
   metrics:{fin:84, demand:81, docs:88, delay:20, data:86},
   risks:['Снижение платёжеспособного спроса на жильё','Рост себестоимости строительства','Сдвиг сроков ввода очередей']},
  {id:'logi', name:'Логистический центр', industry:'Логистика', icon:'truck', target:540000, term:30, risk:41, transparency:71, readiness:55, ret:19,
   desc:'Распределительный центр класса «А» площадью 85 тыс. м² рядом с федеральной трассой, с автоматизированной системой сортировки.',
   scenario:'Базовый: ≈ 19% годовых (демо). Консервативный: ≈ 10%. Стресс: −8% при перенасыщении складского рынка.',
   metrics:{fin:72, demand:77, docs:68, delay:38, data:70},
   risks:['Конкуренция с крупными операторами','Зависимость от тарифов перевозчиков','Задержки поставки оборудования']},
  {id:'agro', name:'Агропромышленный комплекс', industry:'АПК', icon:'wheat', target:390000, term:42, risk:47, transparency:64, readiness:49, ret:21,
   desc:'Мясомолочный кластер полного цикла: фермы на 2 400 голов, цех переработки и фирменная сеть реализации продукции.',
   scenario:'Базовый: ≈ 21% годовых (демо). Консервативный: ≈ 11%. Стресс: −10% при падении закупочных цен.',
   metrics:{fin:66, demand:82, docs:58, delay:46, data:61},
   risks:['Волатильность закупочных цен','Ветеринарные и эпизоотические риски','Сезонность денежного потока']},
  {id:'green', name:'Тепличный комплекс', industry:'АПК', icon:'wheat', target:340000, term:24, risk:44, transparency:68, readiness:63, ret:23,
   desc:'Круглогодичный тепличный комплекс 12 га с досветкой и капельным поливом, контракты с федеральными сетями.',
   scenario:'Базовый: ≈ 23% годовых (демо). Консервативный: ≈ 12%. Стресс: −11% при обвале цен на овощи.',
   metrics:{fin:69, demand:80, docs:64, delay:41, data:66},
   risks:['Рост цен на газ и электроэнергию','Конкуренция с импортом в сезон','Зависимость от сетевых контрактов']},
  {id:'tech', name:'Технологический стартап', industry:'Технологии', icon:'cpu', target:260000, term:24, risk:62, transparency:58, readiness:37, ret:34,
   desc:'ИИ-платформа предиктивного обслуживания промышленного оборудования: пилоты на трёх заводах, подписочная модель монетизации.',
   scenario:'Базовый: ≈ 34% годовых (демо). Консервативный: ≈ 15%. Стресс: −18% при сдвиге инвестиционного раунда.',
   metrics:{fin:55, demand:86, docs:52, delay:55, data:64},
   risks:['Технологическое устаревание решения','Зависимость от ключевых специалистов','Длинный цикл продаж в промышленности']},
  {id:'data', name:'Дата-центр', industry:'Технологии', icon:'cpu', target:560000, term:24, risk:49, transparency:66, readiness:52, ret:26,
   desc:'Модульный дата-центр уровня Tier III на 900 стоек с резервированием питания и контрактами на colocate-услуги.',
   scenario:'Базовый: ≈ 26% годовых (демо). Консервативный: ≈ 13%. Стресс: −12% при дефиците мощностей подключения.',
   metrics:{fin:63, demand:83, docs:62, delay:48, data:67},
   risks:['Дефицит электрических мощностей','Быстрое удешевление оборудования','Зависимость от нескольких якорных клиентов']},
  {id:'med', name:'Медицинский центр', industry:'Здравоохранение', icon:'shield', target:470000, term:45, risk:31, transparency:85, readiness:70, ret:13,
   desc:'Многопрофильный медицинский центр на 240 посещений в смену: диагностика, дневной стационар и программа ДМС.',
   scenario:'Базовый: ≈ 13% годовых (демо). Консервативный: ≈ 8%. Стресс: −3% за счёт смешанной модели оплаты.',
   metrics:{fin:81, demand:85, docs:84, delay:18, data:82},
   risks:['Лицензирование медицинских услуг','Кадровый дефицит врачей','Сроки поставки медицинского оборудования']},
  {id:'soc', name:'Социальная инфраструктура', industry:'Соцсфера', icon:'school', target:450000, term:60, risk:22, transparency:90, readiness:81, ret:9,
   desc:'Сеть из шести школ и двух поликлиник на условиях государственно-частного партнёрства с платежами по концессионному соглашению.',
   scenario:'Базовый: ≈ 9% годовых (демо). Консервативный: ≈ 6%. Стресс: −2% за счёт гарантий концессионера.',
   metrics:{fin:88, demand:84, docs:92, delay:14, data:88},
   risks:['Изменение условий концессии','Длительный срок окупаемости','Кадровый дефицит в регионе']},
];
function projById(id:string):Project {
  for (var i = 0; i < PROJECTS.length; i++) { if (PROJECTS[i].id === id) return PROJECTS[i]; }
  return PROJECTS[0];
}
const INDUSTRIES_COUNT = new Set(PROJECTS.map(p => p.industry)).size;

const STRATEGIES:{id:StrategyId; name:string; tagline:string; desc:string; bullets:string[]; conc:number}[] = [
  {id:'careful', name:'Осторожная', tagline:'Контроль · Проверка · Надёжность',
   desc:'Ставка на проверенные активы с высокой прозрачностью, полным пакетом документов и низким индексом риска.',
   bullets:['Приоритет прозрачности и документации','Порог концентрации в одном проекте — 50%','Сниженная волатильность рыночных событий'], conc:50},
  {id:'balanced', name:'Сбалансированная', tagline:'Диверсификация · Отрасли · Сроки',
   desc:'Сочетает разные отрасли и сроки реализации — баланс между условной доходностью и контролем рисков.',
   bullets:['Бонус к скорингу за 3+ отрасли в портфеле','Порог концентрации — 60%','Умеренная волатильность событий'], conc:60},
  {id:'innov', name:'Инновационная', tagline:'Технологии · Новые модели · Рост',
   desc:'Повышенное внимание к технологическим проектам и новым бизнес-моделям при повышенной волатильности.',
   bullets:['Бонус технологическим проектам в скоринге','Высокий потенциал условной доходности','Повышенная волатильность событий'], conc:65},
];

/* ================= БИБЛИОТЕКА СОБЫТИЙ КРИЗИСНОГО СИМУЛЯТОРА (61) ================= */
const EVS:EvDef[] = [
  {id:'b1', cat:'Строительство', diff:1, w:10, t:'Скачок цен на металлопрокат',
   d:'Металлурги подняли прайс на 18% с началом сезона. Смета объектов под давлением.',
   o:[
    {l:'Зафиксировать объёмы у базового поставщика', e:{capPct:-0.8, risk:-2}, n:'Предоплата за фиксацию цен съела часть капитала, но риск дальнейшего роста смет погашен: удорожание компенсировано фиксированной ценой.'},
    {l:'Разделить закупки между трейдерами', e:{capPct:-0.4, delay:1, risk:2}, n:'Спот-закупки вышли дешевле, однако партии шли вразнобой — график стал менее предсказуемым, риск вырос.'},
    {l:'Перейти на ЖБИ-аналоги в части конструкций', e:{capPct:0.3, delay:2, risk:3}, n:'Замена конструкций сэкономила металл, но потребовала корректировки проектных решений и сдвинула монтаж.'}]},
  {id:'b2', cat:'Строительство', diff:1, w:9, t:'Срыв бетонных работ из-за погоды',
   d:'Аномальные дожди остановили монолитные работы на 2 недели. Критический путь под угрозой.',
   o:[
    {l:'Ввести вторую смену и обогрев', e:{capPct:-0.6, delay:-1}, n:'Дополнительная смена и технологический обогрев вернули график, издержки выросли, но сроки компенсированы.'},
    {l:'Сдвинуть график и переупорядочить работы', e:{delay:2}, n:'Работы перестроены: бетон переносится, на фронте идут внутренние процессы. Срок сдвинулся, зато бюджет цел.'},
    {l:'Ждать улучшения погоды', e:{delay:3, risk:2}, n:'Ожидание затянулось сильнее прогноза: критический путь удлинился, к работам вернулись с отставанием.'}]},
  {id:'b3', cat:'Строительство', diff:2, w:7, t:'Неизвестные коммуникации на площадке',
   d:'При земляных работах вскрыты неучтённые сети. Есть риск повреждения и штрафов.',
   o:[
    {l:'Заказать обследование и согласование', e:{capPct:-0.4, delay:1, transp:2}, n:'Обследование задокументировало сети: работы продолжены по согласованной схеме, прозрачность выросла, время потрачено.'},
    {l:'Обходной проект трассировки', e:{capPct:-0.9, delay:2, risk:-1}, n:'Обходное решение исключило конфликт с сетями, но добавило метраж и время. Риск повреждения снят дорогой ценой.'},
    {l:'Продолжить работы с осторожностью', e:{risk:6, transp:-2}, n:'Работы продолжены без документирования: повреждение сетей обошлось дорого по рискам, а отсутствие согласований ударило по прозрачности.'}]},
  {id:'b4', cat:'Строительство', diff:2, w:6, t:'Обновление строительных норм',
   d:'Изменились нормативные требования к несущим конструкциям. Часть проекта нужно сверить.',
   o:[
    {l:'Провести сверку и корректировку проекта', e:{capPct:-0.7, transp:3, risk:-2}, n:'Сверка выявила два узла, требующих усиления: проект скорректирован, соответствие нормам задокументировано.'},
    {l:'Ограничиться экспертным заключением', e:{capPct:-0.2, risk:2}, n:'Заключение сняло остроту вопроса, но часть узлов осталась без проектной проработки — риск накопился.'},
    {l:'Отложить до следующей стадии', e:{risk:4, delay:1}, n:'Вопрос отложен: недавние конструкции придётся проверять позже, когда переделка будет дороже.'}]},
  {id:'b5', cat:'Строительство', diff:3, w:5, t:'Ошибка геологии: слабые грунты',
   d:'Дополнительное бурение показало грунты слабее проектных под одним из корпусов.',
   o:[
    {l:'Свайное поле по факту геологии', e:{capPct:-1.4, risk:-3}, n:'Основание усилено сваями: дорого, но конструкция соответствует факту. Смета обновлена, риски просадки закрыты.'},
    {l:'Перепроектировать с облегчённой конструкцией', e:{capPct:-0.5, delay:3, risk:2}, n:'Облегчённое решение дешевле, но перепроектирование сдвинуло сроки, а запас прочности стал тоньше.'},
    {l:'Положиться на исходное заключение', e:{risk:7, transp:-3}, n:'Решено не реагировать: расхождение между фактом и проектом зафиксировано в отчётах — риск и репутация просели.'}]},
  {id:'b6', cat:'Строительство', diff:2, w:7, t:'Претензии технадзора к качеству',
   d:'Технадзор выдал замечания по скрытым работам на одном объекте.',
   o:[
    {l:'Переделать работы по замечаниям', e:{capPct:-0.8, risk:-2, transp:2}, n:'Замечания устранены с переисполнением: акты подписаны, журнал чист, прозрачность выросла.'},
    {l:'Оспорить замечания с экспертизой', e:{capPct:-0.3, delay:1}, n:'Независимая экспертиза подтвердила половину замечаний: их устранили, спорные сняли, но время на процедуру ушло.'},
    {l:'Подписать с оговорками', e:{risk:4, transp:-2}, n:'Акты подписаны с оговорками: формально объект движется, качество зафиксировано как риск на будущее.'}]},
  {id:'b7', cat:'Строительство', diff:2, w:7, t:'Дефицит рабочих рук в регионе',
   d:'Сопредельные стройки перетянули монтажников. Фронт работ простаивает.',
   o:[
    {l:'Вахтовый метод с доставкой', e:{capPct:-0.7, delay:-1}, n:'Вахтовые бригады закрыли фронт: график выровнялся, издержки на логистику персонала выросли.'},
    {l:'Привлечь генподрядчика к ответственности', e:{capPct:0.4, risk:3, delay:1}, n:'Штрафные санкции вернули часть средств, но отношения с генподрядчиком испортились — координация осложнилась.'},
    {l:'Поднять ставки и нанимать локально', e:{capPct:-0.5, risk:1}, n:'Ставки подняты, набор идёт медленнее, но команда лояльнее: умеренные издержки, умеренный риск.'}]},
  {id:'m1', cat:'Рынок', diff:2, w:9, t:'Конкурент открылся по соседству',
   d:'На смежной площадке запустился объект-аналог с агрессивной входной ценой.',
   o:[
    {l:'Демпинговая кампания на 2 квартала', e:{capPct:-1.0, risk:2}, n:'Цены снижены: поток удержан, маржа временно сжата. Конкурент также потерял маржу — война цен дорого обоим.'},
    {l:'Уйти в дифференциацию сервиса', e:{capPct:-0.2, transp:2, risk:-1}, n:'Усилены сервис и гарантии: часть клиентов осталась за качеством, цена удержана, репутация подросла.'},
    {l:'Мониторить и сохранить цену', e:{risk:3}, n:'Цена сохранена: часть потока ушла к конкуренту, но маржа цела. Решение проверяется рынком.'}]},
  {id:'m2', cat:'Рынок', diff:1, w:9, t:'Рост тарифов логистики',
   d:'Тарифы перевозчиков выросли на 12% — себестоимость поставок увеличилась.',
   o:[
    {l:'Индексировать отпускные цены', e:{capPct:0.6, risk:2}, n:'Цены подняты вслед за издержками: выручка подросла, часть клиентов отреагировала прохладно.'},
    {l:'Оптимизировать маршруты и склад', e:{capPct:-0.3, delay:1, risk:-1}, n:'Маршрутная сеть перестроена: издержки частично погашены, отгрузки стали чуть медленнее, риск логистики снизился.'},
    {l:'Компенсировать из маржи', e:{capPct:-0.6}, n:'Издержки поглощены маржой: цены стабильны для клиентов, капитал недобрал рост.'}]},
  {id:'m3', cat:'Рынок', diff:1, w:8, t:'Якорный клиент просит скидку за объём',
   d:'Крупный клиент готов подписать 3-летний контракт при скидке 8%.',
   o:[
    {l:'Подписать контракт со скидкой', e:{capPct:1.6, risk:-2, transp:2}, n:'Длинный контракт с дисконтом: устойчивый поток перекрывает скидку, прозрачность выручки выросла.'},
    {l:'Предложить скидку 4% и короче срок', e:{capPct:0.9, risk:1}, n:'Компромисс найден: контракт меньше и дороже — баланс между потоком и маржой.'},
    {l:'Отказаться от скидки', e:{risk:4}, n:'Переговоры прерваны: клиент ушёл в тендер, поток на горизонте неопределён.'}]},
  {id:'m4', cat:'Рынок', ind:['АПК','Недвижимость'], diff:2, w:7, t:'Смещение потребительского тренда',
   d:'Отраслевые панели фиксируют сдвиг спроса к формату, которого нет в проекте.',
   o:[
    {l:'Пилот новой линейки под тренд', e:{capPct:-0.5, risk:2, transp:2}, n:'Пилот запущен: реакция рынка положительная, издержки на запуск умеренные, данные для решения собраны.'},
    {l:'Адаптировать существующий продукт', e:{delay:2, capPct:0.4}, n:'Текущая линейка доработана под тренд: быстрее и дешевле пилота, часть сегмента упущена.'},
    {l:'Держать позиционирование', e:{risk:4}, n:'Ставка на прежнее позиционирование: тренд догоняет не всех — риск устаревания зафиксирован.'}]},
  {id:'m5', cat:'Рынок', ind:['АПК','Энергетика'], diff:2, w:6, t:'Интерес зарубежного покупателя',
   d:'Внешнеторговое объединение запросило условия поставок на экспорт.',
   o:[
    {l:'Подготовить экспортную партию', e:{capPct:1.4, risk:2}, n:'Пилотная экспортная партия отгружена: выручка подросла, валютный и логистический риск появился.'},
    {l:'Сначала аудит соответствия стандартам', e:{capPct:0.3, transp:3, delay:1}, n:'Соответствие стандартам подтверждено документально: экспорт отложен, но подготовлен качественно.'},
    {l:'Отложить экспортное направление', e:{}, n:'Фокус на внутреннем рынке: ресурсов на экспорт не выделили, возможность упущена без потерь.'}]},
  {id:'m6', cat:'Рынок', ind:['АПК','Здравоохранение','Логистика'], diff:1, w:8, t:'Сезонный всплеск раньше срока',
   d:'Спрос вырос на месяц раньше сезонной нормы. Мощности загружены под завязку.',
   o:[
    {l:'Максимизировать загрузку мощностей', e:{capPct:1.8, risk:3}, n:'Мощности работают на пределе: выручка резко подросла, износ и сбои подняли риск.'},
    {l:'Равномерно распределить поток', e:{capPct:1.0, risk:1}, n:'Очереди сглажены записями и слотами: рост умеренный, операционный риск под контролем.'},
    {l:'Работать в обычном режиме', e:{capPct:0.3}, n:'Ограничились базовой загрузкой: скромный прирост, оборудование и персонал не перегружены.'}]},
  {id:'m7', cat:'Рынок', ind:['АПК','Здравоохранение'], diff:2, w:6, t:'Конкурент отзывает продукт',
   d:'Крупный игрок отозвал продукт из-за претензий к качеству. Ниша освобождается.',
   o:[
    {l:'Ускоренно занять освободившуюся нишу', e:{capPct:2.2, risk:3}, n:'Ниша занята ускоренно: выручка выросла, нарастили запасы и персонал — операционный риск подрос.'},
    {l:'Занять нишу с контролем качества', e:{capPct:1.4, transp:3, delay:1}, n:'Вход в нишу с усиленным контролем: медленнее, но без эффекта «сырого» продукта — прозрачность и доверие выше.'},
    {l:'Не менять планы', e:{}, n:'Возможность пропущена: нишу перераспределят другие игроки, зато план не ломался.'}]},
  {id:'m8', cat:'Рынок', ind:['Недвижимость'], diff:2, w:7, t:'Сужение ипотечной программы',
   d:'Государственная программа льготной ипотеки сокращена — платёжеспособный спрос охладел.',
   o:[
    {l:'Запустить собственную рассрочку', e:{capPct:-0.6, risk:3}, n:'Корпоративная рассрочка поддержала продажи, но риск неплатежей лёг на баланс проекта.'},
    {l:'Сместить фокус на коммерческие площади', e:{capPct:0.4, delay:2, risk:1}, n:'Коммерческий этаж выведен раньше: смягчило охлаждение жилья, потребовало перепрофилирования.'},
    {l:'Скорректировать темп продаж', e:{delay:2, risk:1}, n:'График продаж растянут: без резких движений, выручка сдвинулась вправо.'}]},
  {id:'f1', cat:'Финансы', diff:1, w:10, t:'Повышение ключевой ставки',
   d:'Ставка выросла на 2 п.п. — обслуживание заёмного финансирования дорожает.',
   o:[
    {l:'Зафиксировать ставку на текущем транше', e:{capPct:-0.5, risk:-2}, n:'Ставка зафиксирована: предоплата комиссии, зато обслуживание предсказуемо, риск ставок снят.'},
    {l:'Реструктурировать график долга', e:{delay:1, risk:1}, n:'График растянут: нагрузка сглажена, срок кредита фактически увеличен.'},
    {l:'Принять новые условия', e:{capPct:-0.9, risk:2}, n:'Кредит подорожал полностью: капитал недобрал, процентный риск остался на проекте.'}]},
  {id:'f2', cat:'Финансы', diff:2, w:8, t:'Задержка платежей якорного клиента',
   d:'Ключевой клиент задерживает оплату на 6 недель. Кассовый план ломается.',
   o:[
    {l:'Факторинг дебиторки', e:{capPct:-0.7, risk:-2}, n:'Дебиторка продана фактору: деньги пришли сейчас, дисконт — цена скорости. Риск неплатежа передан.'},
    {l:'Договориться о графике погашения', e:{delay:1, risk:2}, n:'С клиентом согласован график: деньги придут частями, кассовый план скорректирован.'},
    {l:'Жёсткая претензия и штрафы', e:{capPct:0.5, risk:4}, n:'Претензия выставлена со штрафами: деньги вернутся с процентами, но отношения с якорем испорчены.'}]},
  {id:'f3', cat:'Финансы', ind:['Технологии','Энергетика','Логистика'], diff:2, w:7, t:'Валютные колебания по импорту',
   d:'Курс ушёл на 9% против контрактных условий закупки оборудования.',
   o:[
    {l:'Хеджировать курс по контракту', e:{capPct:-0.6, risk:-2}, n:'Хедж зафиксировал курс: премия уплачена, валютный риск снят с проекта.'},
    {l:'Договариваться о пересмотре цены', e:{capPct:-0.3, delay:1, risk:2}, n:'Поставщик согласился на разделение роста: часть поглощена, переговоры заняли время.'},
    {l:'Принять курсовой убыток', e:{capPct:-1.1, risk:2}, n:'Убыток принят полностью: закупка прошла без задержек, капитал просел сильнее необходимого.'}]},
  {id:'f4', cat:'Финансы', diff:2, w:7, t:'Предложение банка о дополнительном транше',
   d:'Банк предлагает транш под залог свободного резерва по ставке ниже рынка.',
   o:[
    {l:'Взять транш под модернизацию', e:{capPct:1.5, risk:2, rep:2}, n:'Дешёвый транш усилен в проекты: потенциал выручки вырос, долг и его обслуживание добавили риска.'},
    {l:'Взять транш в ликвидный резерв', e:{reservePct:25, risk:-2, rep:1}, n:'Транш лёг в резерв: подушка для кризисов стала толще, ставки по нему ниже рынка.'},
    {l:'Отказаться от заимствования', e:{}, n:'Отказ от долга: баланс остался чистым, возможность удешевлённого финансирования упущена.'}]},
  {id:'f5', cat:'Финансы', cond:'lowRes', diff:2, w:8, t:'Аудитор: вопросы к кассовым разрывам',
   d:'Аудиторская компания запросила пояснения по эпизодам отрицательного остатка.',
   o:[
    {l:'Полный аудит казначейства', e:{capPct:-0.5, transp:4, risk:-2, quality:2}, n:'Аудит перестроил кассовый план: разрывы закрыты регламентом, прозрачность резко выросла.'},
    {l:'Пояснительная записка без аудита', e:{transp:1, risk:2}, n:'Пояснения отправлены: формально вопрос снят, системная причина разрывов осталась.'},
    {l:'Игнорировать запрос', e:{rep:-6, risk:3, transp:-3}, n:'Запрос проигнорирован: аудитор отметил непрозрачность в отчёте — репутация и доверие просели.'}]},
  {id:'f6', cat:'Финансы', diff:2, w:6, t:'Налоговая проверка: вопросы к вычетам',
   d:'Инспекция запросила документы по части вычетов НДС за прошлый период.',
   o:[
    {l:'Передать документы и корректировки', e:{capPct:-0.4, transp:3, risk:-1}, n:'Документы переданы, спорные вычеты скорректированы: доначисление минимальное, прозрачность выше.'},
    {l:'Защищать позицию с консультантом', e:{capPct:-0.6, delay:1}, n:'Позиция защищена: большая часть вычетов сохранена, издержки на консультанта и время потрачены.'},
    {l:'Откладывать ответ', e:{risk:5, rep:-3}, n:'Ответ затянут: пени и штрафные проценты начислены, в отчёте появилось замечание о дисциплине.'}]},
  {id:'f7', cat:'Финансы', diff:1, w:6, t:'Окно досрочного погашения',
   d:'Кредитор предлагает скидку 3% при досрочном погашении части тела долга.',
   o:[
    {l:'Погасить часть долга досрочно', e:{capPct:-0.8, risk:-3}, n:'Долг уменьшен со скидкой: процентная нагрузка снижена, свободный капитал сократился.'},
    {l:'Погасить минимальный транш', e:{capPct:-0.3, risk:-1}, n:'Погашен минимальный транш: умеренная экономия на процентах, ликвидность сохранена.'},
    {l:'Держать деньги в работе', e:{capPct:0.4, risk:2}, n:'Капитал оставлен в обороте: доходность перекрыла скидку, долговая нагрузка сохранена.'}]},
  {id:'f8', cat:'Финансы', ind:['АПК','Энергетика'], diff:1, w:6, t:'Выгодное курсовое окно для экспорта',
   d:'Курс экспортной выручки временно укрепился на 7%.',
   o:[
    {l:'Ускорить отгрузку экспортной партии', e:{capPct:1.6, delay:-1}, n:'Партия отгружена в окно: курсовая премия зафиксирована, логистика поработала на опережение.'},
    {l:'Оформить форвард на курс', e:{capPct:0.8, risk:-1}, n:'Форвард зафиксировал курс без спешки: часть премии сохранена, риск снят.'},
    {l:'Не менять график отгрузок', e:{}, n:'График сохранён: окно прошло мимо, но и операционных напряжений не возникло.'}]},
  {id:'d1', cat:'Документы', diff:2, w:8, t:'Проектная документация разошлась с фактом',
   d:'Инвентаризация выявила несоответствие фактических решений проектной документации.',
   o:[
    {l:'Внести изменения в проектную документацию', e:{capPct:-0.5, transp:4, risk:-2}, n:'Документация приведена к факту: соответствие подтверждено, прозрачность выросла заметно.'},
    {l:'Оформить технические акты отклонений', e:{capPct:-0.2, transp:2, risk:1}, n:'Отклонения оформлены актами: формально чисто, системного приведения не произошло.'},
    {l:'Отложить до следующей проверки', e:{risk:4, transp:-2}, n:'Вопрос отложен: на следующей проверке несоответствие будет дороже исправлять.'}]},
  {id:'d2', cat:'Документы', diff:2, w:8, t:'Истекает срок ключевого разрешения',
   d:'Разрешение на реализацию действует ещё 60 дней, продление требует 90.',
   o:[
    {l:'Подать на продление немедленно', e:{capPct:-0.3, transp:3, risk:-2}, n:'Заявление подано заблаговременно: процесс идёт параллельно работам, риск паузы снят.'},
    {l:'Параллельно готовить альтернативный регламент', e:{capPct:-0.6, delay:1, risk:-1}, n:'Резервный регламент подготовлен: страховка на случай отказа, издержки на дублирование.'},
    {l:'Ждать ближе к сроку', e:{delay:2, risk:5}, n:'Подача отложена: очередь и замечания сдвинули продление — работы встали в ожидании бумаги.'}]},
  {id:'d3', cat:'Документы', ind:['Энергетика','АПК','Недвижимость'], diff:2, w:6, t:'Дополнительное экологическое заключение',
   d:'Надзор затребовал расширенное экологическое заключение по площадке.',
   o:[
    {l:'Заказать полную экологическую оценку', e:{capPct:-0.7, transp:4, delay:1, rep:2}, n:'Оценка проведена: заключение получено, репутация ответственного застройщика укрепилась.'},
    {l:'Ограничиться декларацией соответствия', e:{capPct:-0.2, transp:1, risk:2}, n:'Декларация оформлена: формально требование закрыто, глубина проверки минимальна.'},
    {l:'Оспаривать требование', e:{delay:2, risk:3, rep:-2}, n:'Требование оспорено: процедура затянулась, отношения с надзором охладели.'}]},
  {id:'d4', cat:'Документы', diff:1, w:7, t:'Регулятор: раскрытие структуры владения',
   d:'Новое требование — раскрыть конечных бенефициаров структуры проекта.',
   o:[
    {l:'Раскрыть структуру полностью', e:{transp:4, rep:2}, n:'Структура раскрыта: соответствие требованию, доверие инвесторов к проекту подросло.'},
    {l:'Раскрыть в минимальном объёме', e:{transp:1}, n:'Раскрытие по формальному минимуму: требование исполнено, вопросов у инвесторов меньше не стало.'},
    {l:'Отложить раскрытие', e:{rep:-4, risk:2}, n:'Раскрытие отложено: регулятор отметил нарушение сроков, репутация пострадала.'}]},
  {id:'d5', cat:'Документы', diff:1, w:7, t:'Дубли заявок в компенсациях подрядчика',
   d:'Сверка выявила дублирующие заявки на компенсацию от подрядчика.',
   o:[
    {l:'Провести полную сверку взаиморасчётов', e:{capPct:0.6, transp:3, quality:2}, n:'Сверка нашла ещё расхождения: дубли сняты, переплата возвращена, прозрачность расчётов выросла.'},
    {l:'Снять только выявленные дубли', e:{capPct:0.3}, n:'Дубли сняты: экономия зафиксирована, полную сверку решили не делать.'},
    {l:'Не заострять вопрос', e:{capPct:-0.4, transp:-2}, n:'Вопрос замят: подрядчик привычно завышает заявки, контроль ослаблен — потеря повторится.'}]},
  {id:'d6', cat:'Документы', diff:1, w:7, t:'Пожарный аудит: предписание',
   d:'Аудит противопожарной защиты выдал предписание по путям эвакуации.',
   o:[
    {l:'Немедленно устранить предписание', e:{capPct:-0.5, risk:-3, transp:2}, guardRes:50000, n:'Предписание устранено в срок: безопасность закрыта, штрафных рисков нет. При нехватке резерва работы шли частично и эффект слабее.'},
    {l:'План устранения с рассрочкой', e:{capPct:-0.2, risk:1, delay:1}, n:'Согласован план с этапами: часть мер сразу, часть позже — компромисс с надзором.'},
    {l:'Обжаловать предписание', e:{risk:4, rep:-2}, n:'Предписание обжалуется: работы идут с риском штрафа, надзор держит объект на контроле.'}]},
  {id:'d7', cat:'Документы', cond:'docsLow', diff:2, w:7, t:'Комплексная проверка: пробелы в пакете',
   d:'Регламентная проверка выявила неполный пакет разрешительных документов.',
   o:[
    {l:'Восстановить пакет по чек-листу компаса', e:{capPct:-0.4, transp:5, risk:-3, quality:2}, ins:'docs', n:'Чек-лист компаса позволил закрыть пробелы адресно: пакет полный, прозрачность заметно выросла.'},
    {l:'Погасить критичные позиции пакета', e:{capPct:-0.2, transp:2, risk:1}, n:'Критичные документы восстановлены: второстепенные позиции остались на будущую проверку.'},
    {l:'Аргументировать достаточность пакета', e:{risk:4, transp:-2}, n:'Достаточность отстаётся: проверяющие внесли замечание — риск вырос, прозрачность упала.'}]},
  {id:'t1', cat:'Технологии', ind:['Технологии','Энергетика','Логистика'], diff:2, w:10, t:'Задержка поставки ключевого оборудования',
   d:'Производитель сдвинул отгрузку ключевого оборудования на 8 недель.',
   o:[
    {l:'Доплатить за приоритетную сборку', e:{per100k:-3000, delay:-2}, n:'Приоритетная линия вернула график: доплата — цена скорости, монтаж пройдёт по плану.'},
    {l:'Перестроить график монтажа', e:{delay:2, risk:2}, n:'Монтаж перестроен: смежные работы выведены вперёд, критический этап всё же сместился.'},
    {l:'Арендовать оборудование на переходный период', e:{capPct:-0.8, delay:-1, risk:1}, guardRes:80000, n:'Арендная единица закрыла разрыв: дорого, но график почти не пострадал. При нехватке резерва аренда вышла короче и слабее.'},
    {l:'Активировать резервного поставщика', e:{per100k:1000, delay:-2, risk:-1}, ins:'supplier', n:'Инсайт «Резервный подрядчик» сработал: заранее согласованная альтернатива поставила оборудование в срок и даже чуть дешевле.'}]},
  {id:'t2', cat:'Технологии', ind:['Технологии'], diff:2, w:7, t:'Уязвимость в системе управления',
   d:'Багбаунти-исследователи сообщили об уязвимости в промышленной системе.',
   o:[
    {l:'Экстренный патч и аудит', e:{capPct:-0.5, risk:-3, transp:2, quality:2}, n:'Патч развёрнут за сутки, аудит подтвердил закрытие: инцидент показал зрелость процессов.'},
    {l:'Компенсирующие меры без патча', e:{risk:2, transp:1}, n:'Доступ ограничен компенсирующими мерами: уязвимость живёт, риск остаётся умеренным.'},
    {l:'Отложить до планового релиза', e:{risk:5, rep:-2}, n:'Патч отложен: исследователи опубликовали детали — репутационный урон и риск эксплуатации.'}]},
  {id:'t3', cat:'Технологии', ind:['Технологии','Энергетика'], diff:2, w:6, t:'Выход нового поколения оборудования',
   d:'Анонсировано поколение оборудования на 30% эффективнее закупленного.',
   o:[
    {l:'Докупить модуль нового поколения', e:{capPct:-0.9, risk:1}, n:'Модуль нового поколения внедрён в ключевой узел: экономика улучшилась, капитал вложен.'},
    {l:'Пересмотреть конфигурацию эксплуатации', e:{capPct:0.5, delay:1, risk:1}, n:'Тюнинг текущего парка выжал дополнительные проценты: без затрат на закупку, время на наладку.'},
    {l:'Работать на имеющемся парке', e:{}, n:'Парк оставлен как есть: конкурентное отставание зафиксировано в плане на будущее.'}]},
  {id:'t4', cat:'Технологии', ind:['Технологии'], diff:1, w:7, t:'Проблемы интеграции у заказчика',
   d:'Пилотный заказчик столкнулся со сложной интеграцией с его устаревшими системами.',
   o:[
    {l:'Выделить команду интеграции', e:{capPct:-0.6, delay:-1, rep:2}, n:'Выделенная команда закрыла интеграцию: пилот спасён, репутация надёжного вендора выросла.'},
    {l:'Обучить ИТ-команду заказчика', e:{capPct:-0.2, delay:1, transp:2}, n:'Обучение и документация переданы заказчику: дешевле, дольше, прозрачнее для обеих сторон.'},
    {l:'Сузить объём пилота', e:{capPct:0.2, risk:3}, n:'Пилот урезан: интеграция упрощена, но кейс стал менее показательным для следующих продаж.'}]},
  {id:'t5', cat:'Технологии', ind:['Технологии','Здравоохранение'], diff:2, w:6, t:'Отказ резервного генератора на тесте',
   d:'Тестовое переключение выявило отказ резервного энергоснабжения.',
   o:[
    {l:'Капремонт и новые тесты', e:{capPct:-0.7, risk:-3, transp:2}, n:'Генератор отремонтирован, тест пройден дважды: критическая зависимость закрыта документально.'},
    {l:'Временная аренда генератора на период', e:{capPct:-0.4, risk:1}, n:'Арендный генератор прикрывает риск: постоянное решение отложено, прикрытие работает.'},
    {l:'Перенести тесты', e:{risk:5}, n:'Тесты перенесены: реальная готовность резервов неизвестна — риск зафиксирован без ответа.'}]},
  {id:'t6', cat:'Технологии', ind:['Технологии'], diff:3, w:5, t:'Патентный спор с держателем лицензии',
   d:'Держатель патента заявил претензии к используемому алгоритму.',
   o:[
    {l:'Лицензировать технологию', e:{capPct:-1.0, risk:-3}, n:'Лицензия куплена: спор закрыт юридически, роялти — цена определённости.'},
    {l:'Разработать обходное решение', e:{capPct:-0.5, delay:2, risk:2}, n:'Обходной алгоритм разрабатывается: дешевле лицензии, дольше и с риском неполной эквивалентности.'},
    {l:'Оспаривать патент', e:{capPct:-0.3, delay:1, risk:5}, n:'Встречный иск подан: исход не гарантирован, претензия висит над продуктом.'}]},
  {id:'t7', cat:'Технологии', diff:2, w:8, t:'Фишинговая атака на бухгалтерию',
   d:'Массовая фишинговая кампания: попытки перехвата платёжных реквизитов.',
   o:[
    {l:'Аварийный аудит и обучение', e:{capPct:-0.4, risk:-3, transp:2, quality:2}, n:'Аудит нашёл 2 компрометации на ранней стадии, сотрудники обучены: инцидент стал уроком без потерь.'},
    {l:'Двойное подтверждение платежей', e:{capPct:-0.1, risk:-1, delay:1}, n:'Регламент с двойным подтверждением введён: платежи стали медленнее, канал перекрыт.'},
    {l:'Рассылка о бдительности', e:{risk:3}, n:'Ограничились рассылкой: человеческий фактор остался главной уязвимостью.'}]},
  {id:'t8', cat:'Технологии', ind:['Технологии','Энергетика'], diff:2, w:6, t:'Дефицит полупроводников',
   d:'Поставщик чипов объявил дефицит: очереди на 4 месяца.',
   o:[
    {l:'Выкупить объём вперёд', e:{capPct:-0.7, risk:-2}, n:'Объём выкуплен вперёд: склад закрыл потребность, деньги заморожены в запасе.'},
    {l:'Заменить на доступные аналоги', e:{capPct:-0.2, risk:3, delay:1}, n:'Аналоги вшиты в конструкцию: доступно сейчас, интеграционные риски всплывут при эксплуатации.'},
    {l:'Ждать производственную очередь', e:{delay:3, risk:1}, n:'Очередь ждать честно: без затрат, но график монтажа ушёл на квартал.'}]},
  {id:'p1', cat:'Партнёры', diff:2, w:9, t:'Подрядчик требует пересмотр цены',
   d:'Генподрядчик ссылается на рост издержек и просит +7% к договору.',
   o:[
    {l:'Согласовать пересмотр с аудитом сметы', e:{capPct:-0.5, transp:3, risk:-1}, n:'Аудит подтвердил половину претензии: удорожание справедливое, задокументированное, риск конфликта снят.'},
    {l:'Жёстко держать договор', e:{risk:4, delay:1}, n:'Договор не тронут: подрядчик работает с прохладцей, темпы снизились, конфликт тлеет.'},
    {l:'Разделить рост 50/50', e:{capPct:-0.3, risk:1}, n:'Компромисс: рост поделен — отношения сохранены, издержки умеренные.'}]},
  {id:'p2', cat:'Партнёры', diff:3, w:6, t:'Банкротство субподрядчика',
   d:'Субподрядчик по инженерным сетям признан банкротом. Работы остановлены.',
   o:[
    {l:'Быстрый подбор нового субподрядчика', e:{capPct:-0.8, delay:1, risk:1}, guardRes:50000, n:'Новый субподрядчик вышел на площадку за неделю: разрыв закрыт, вход нового игрока дороже. При нехватке резерва на аванс подбор шёл дольше и эффект слабее.'},
    {l:'Забрать фронт себе и искать исполнителей напрямую', e:{capPct:-0.5, delay:2, risk:2, transp:2}, n:'Функция взята на прямое управление: прозрачность выросла, сроки и ответственность легли на проект.'},
    {l:'Взыскать с банкрота и ждать', e:{delay:3, risk:3}, n:'Очередь кредиторов длинная: взыскание растянется, работы стоят — время дороже денег.'}]},
  {id:'p3', cat:'Партнёры', diff:1, w:7, t:'Подрядчик предлагает якорное партнёрство',
   d:'Успешный подрядчик предлагает статус якорного партнёра на 3 года с фиксацией цен.',
   o:[
    {l:'Заключить партнёрское соглашение', e:{capPct:0.8, risk:-2, transp:2}, n:'Якорное соглашение зафиксировало цены и мощность: устойчивость выросла, зависимость от партнёра тоже.'},
    {l:'Соглашение с выходными опциями', e:{capPct:0.4, risk:-1, transp:3}, n:'Соглашение с опциями выхода: гибкость сохранена, условия чуть хуже эксклюзива, прозрачнее.'},
    {l:'Работать по разовым договорам', e:{risk:2}, n:'Разовые договоры: свобода выбора, но цены и загрузка остались рыночными и волатильными.'}]},
  {id:'p4', cat:'Партнёры', diff:1, w:7, t:'Разрыв расчётов в цепочке',
   d:'Промежуточный контрагент задерживает расчёты ниже по цепочке.',
   o:[
    {l:'Прямые расчёты с конечными исполнителями', e:{capPct:-0.2, transp:3, risk:-2}, n:'Расчёты распрямлены: исполнители получают деньги напрямую, цепочка упростилась и просветлела.'},
    {l:'Гарантийные письма и график', e:{risk:2}, n:'Гарантии получены: система держится на доверии, риск неисполнения остаётся.'},
    {l:'Не вмешиваться', e:{risk:4, rep:-2}, n:'Проект не вмешался: исполнители винят проект в чужих задержках, репутация пострадала.'}]},
  {id:'p5', cat:'Партнёры', diff:2, w:6, t:'Тёмное прошлое нового поставщика',
   d:'Проверка показала судебные споры у нового поставщика материалов.',
   o:[
    {l:'Заменить поставщика до поставок', e:{capPct:-0.3, risk:-3}, n:'Поставщик заменён превентивно: издержки на пересогласование, риск срыва снят заранее.'},
    {l:'Работать с обеспечением и страхованием', e:{capPct:-0.1, risk:1, transp:2}, n:'Обеспечительный платёж и страхование: поставщик остался, риски прикрыты документами.'},
    {l:'Не менять ничего', e:{risk:5}, n:'Поставщик оставлен без мер: срыв поставки стал вопросом времени, риск крупный.'}]},
  {id:'p6', cat:'Партнёры', diff:1, w:6, t:'Приглашение в отраслевой консорциум',
   d:'Отраслевой консорциум приглашает проект в альянс с общими закупками.',
   o:[
    {l:'Вступить в консорциум', e:{capPct:0.9, transp:2, rep:2}, n:'Членство в альянсе: общие закупки снизили цены, обмен практиками поднял репутацию.'},
    {l:'Наблюдатель без обязательств', e:{capPct:0.3}, n:'Статус наблюдателя: часть информации доступна, ценовых преференций нет.'},
    {l:'Отклонить приглашение', e:{}, n:'Отказ: независимость сохранена, синергия альянса упущена.'}]},
  {id:'p7', cat:'Партнёры', diff:2, w:6, t:'Нарушения техники безопасности у подрядчика',
   d:'Инспекция зафиксировала нарушения охраны труда у подрядной бригады.',
   o:[
    {l:'Остановить работы до устранения', e:{delay:1, capPct:-0.3, risk:-3, rep:2}, n:'Работы остановлены до устранения: ответственный подход, репутация выше, время потеряно.'},
    {l:'Предписание с контролем исполнения', e:{capPct:-0.1, risk:1, transp:2}, n:'Предписание выдано: работы продолжаются под контролем, часть рисков осталась живой.'},
    {l:'Формальная беседа', e:{risk:5, rep:-3}, n:'Разговор без последствий: нарушение повторится — авария ударит сильнее любого штрафа.'}]},
  {id:'p8', cat:'Партнёры', diff:1, w:6, t:'Смена менеджмента ключевого партнёра',
   d:'У ключевого партнёра сменилось руководство: приоритеты непонятны.',
   o:[
    {l:'Ранний стратегический визит', e:{capPct:-0.1, risk:-2, transp:2}, n:'Встреча с новым руководством прояснила планы: договорённости переподтверждены, неопределённость снята.'},
    {l:'Диверсифицировать на запасного партнёра', e:{capPct:-0.4, risk:-1, delay:1}, n:'Параллельный партнёр заведён: подстраховка стоит денег и времени.'},
    {l:'Наблюдать за развитием', e:{risk:3}, n:'Позиция выжидания: новые менеджеры могут пересмотреть договорённости — неопределённость живёт.'}]},
  {id:'g1', cat:'Цифра', diff:1, w:7, t:'Сбой узла распределённого реестра (демо)',
   d:'Техническое окно узла ГАНИМЕД затянулось: операции по ЦФА приостановлены.',
   o:[
    {l:'Перевести расчёты на резервный узел', e:{capPct:-0.2, delay:-1, transp:2}, n:'Резервный узел принял нагрузку: расчёты продолжились, архитектура отказоустойчивости подтверждена.'},
    {l:'Дождаться восстановления узла', e:{delay:1}, n:'Узел восстановлен штатно: расчёты сдвинулись на дни, без финансовых потерь.'},
    {l:'Приостановить транши до ясности', e:{delay:2, capPct:-0.3}, n:'Транши заморожены: консервативно и дорого — подрядчики ждали деньги.'}]},
  {id:'g2', cat:'Цифра', diff:2, w:6, t:'Обновление протокола смарт-контрактов (демо)',
   d:'Экосистема НЕКСУС выпускает обновление протокола: нужна миграция активов.',
   o:[
    {l:'Миграция сразу по инструкции', e:{capPct:-0.3, transp:2, quality:2}, n:'Миграция прошла по регламенту: активы актуальны, аудит данных чист.'},
    {l:'Отложить миграцию до дедлайна', e:{risk:3}, n:'Миграция отложена: ближе к дедлайну очереди и ошибки вероятнее.'},
    {l:'Миграция с независимой верификацией', e:{capPct:-0.5, transp:4, quality:3}, n:'Верификатор перепроверил каждую запись: эталонная чистота данных, издержки на двойной контроль.'}]},
  {id:'g3', cat:'Цифра', diff:1, w:6, t:'Инвесторы просят верификацию данных',
   d:'Держатели токенов запросили независимую верификацию показателей проекта.',
   o:[
    {l:'Провести верификацию на ГАНИМЕД (демо)', e:{capPct:-0.2, transp:4, rep:3}, n:'Верификация пройдена и опубликована: доверие инвесторов выросло, приток заявок усилился.'},
    {l:'Публикация выжимки без верификации', e:{transp:1}, n:'Выжимка опубликована: часть вопросов закрыта, скептики остались.'},
    {l:'Ответить отказом', e:{rep:-5, transp:-3}, n:'Отказ расценён как скрытность: доверие инвесторов упало, репутация просела.'}]},
  {id:'g4', cat:'Цифра', diff:2, w:6, t:'Фишинг против участников проекта',
   d:'Мошенники рассылают поддельные страницы от имени платформы проекта.',
   o:[
    {l:'Официальное опровержение и поддержка', e:{capPct:-0.3, rep:2, transp:2}, n:'Опровержение вышло быстро, пострадавшим помогли: доверие к платформе даже укрепилось.'},
    {l:'Техническая блокировка доменов', e:{capPct:-0.1, risk:-1}, n:'Домены заблокированы: канал закрыт, коммуникация с участниками была скудной.'},
    {l:'Не реагировать публично', e:{rep:-4, risk:2}, n:'Молчание: слухи заполнили информационный вакуум, репутация просела.'}]},
  {id:'g5', cat:'Цифра', diff:1, w:5, t:'Новый стандарт отчётности',
   d:'Введён обновлённый стандарт раскрытия показателей проектов.',
   o:[
    {l:'Перейти на стандарт с опережением', e:{capPct:-0.2, transp:3, rep:2}, n:'Переход выполнен раньше срока: эталон дисциплины, регулятор отметил проект положительно.'},
    {l:'Перейти в срок', e:{transp:1}, n:'Переход по графику: соответствие без отличий.'},
    {l:'Просрочить переход', e:{rep:-3, transp:-2}, n:'Просрочка: предупреждение регулятора, вопрос к зрелости процессов.'}]},
  {id:'g6', cat:'Цифра', diff:1, w:6, t:'Одобрена интеграция с маркетплейсом',
   d:'Заявка проекта на размещение в маркетплейсе активов одобрена.',
   o:[
    {l:'Полноценное размещение с кампанией', e:{capPct:1.2, transp:2, rep:2}, n:'Размещение с промо-кампанией: поток заявок вырос, раскрытие данных усилилось.'},
    {l:'Размещение в пилотном режиме', e:{capPct:0.5, risk:1}, n:'Пилотное размещение: канал проверен малым объёмом, рост скромнее.'},
    {l:'Отложить размещение', e:{}, n:'Размещение отложено: витрина пустует, конкурентные проекты заняли внимание инвесторов.'}]},
  {id:'g7', cat:'Цифра', diff:1, w:6, t:'Двойное списание в пилотном платеже (демо)',
   d:'Тестовый платёж через новый шлюз списался дважды на контрольной сумме.',
   o:[
    {l:'Аудит шлюза и возврат средств', e:{capPct:0.2, transp:2, quality:2}, n:'Списание возвращено, шлюз пропатчен: инцидент закрыт корректно, регламент платежей усилен.'},
    {l:'Возврат без аудита', e:{capPct:0.1}, n:'Деньги вернулись: причина не исследована — повторение возможно.'},
    {l:'Игнорировать мелкую сумму', e:{transp:-2, rep:-2}, n:'Мелочь списали в убыток: сумма мала, но сигнал о платформе — небрежный.'}]},
  {id:'w1', cat:'Рост', ind:['Энергетика','АПК'], diff:1, w:8, t:'Субсидия на энергоэффективность',
   d:'Открыта программа субсидий до 15% капзатрат на энергоэффективные решения.',
   o:[
    {l:'Подать заявку с расширенным пакетом', e:{capPct:1.8, transp:2, delay:1}, n:'Заявка одобрена: субсидия покрыла заметную часть капзатрат, сбор документов занял время.'},
    {l:'Заявка по базовому пакету', e:{capPct:0.9}, n:'Субсидия получена по базе: меньше охват, меньше бюрократии.'},
    {l:'Пропустить программу', e:{}, n:'Программа пропущена: конкурсные окна не бесконечны, но и бюрократии не было.'}]},
  {id:'w2', cat:'Рост', ind:['Недвижимость','Соцсфера','Логистика'], diff:2, w:6, t:'Победа в тендере на соседний объект',
   d:'Проект приглашён к исполнению по итогам тендера на смежную площадку.',
   o:[
    {l:'Принять заказ с расширением команды', e:{capPct:1.6, risk:2, delay:1}, n:'Смежный объект принят: выручка подросла, команда и ресурсы растянуты.'},
    {l:'Принять в консорциуме с партнёром', e:{capPct:0.9, risk:-1, transp:2}, n:'Консорциум снизил нагрузку: доля выручки меньше, риски разделены, документация прозрачнее.'},
    {l:'Отказаться от тендера', e:{}, n:'Отказ: фокус на текущем объекте, возможность упущена.'}]},
  {id:'w3', cat:'Рост', diff:2, w:6, t:'Стратегический инвестор интересуется долей',
   d:'Отраслевой фонд запросил условия по миноритарной доле с премией 10% к оценке.',
   o:[
    {l:'Продать миноритарную долю с премией', e:{capPct:2.4, risk:-1, transp:3}, n:'Сделка закрыта: капитал усилен премией, фонд принесёт экспертизу и требования к раскрытию.'},
    {l:'Торг по оценке', e:{capPct:1.3, delay:1}, n:'Торг сдвинул премию вниз: сделка близка, время на переговорах.'},
    {l:'Отклонить интерес', e:{}, n:'Интерес отклонён: независимость сохранена, кэш не пришёл.'}]},
  {id:'w4', cat:'Рост', diff:1, w:7, t:'Опережение графика этапа',
   d:'Ключевой этап завершён на 3 недели раньше плана. Свободен фронт и часть денег.',
   o:[
    {l:'Реинвестировать в следующую стадию', e:{capPct:1.2, transp:2}, n:'Высвобожденные средства пошли в следующую стадию: эффект сложного процента на пользу, отчётность отражает успех.'},
    {l:'Укрепить резерв', e:{reservePct:20, risk:-2}, n:'Опережение конвертировано в резерв: подушка толще, будущее спокойнее.'},
    {l:'Передышка для команды', e:{risk:-2, rep:2}, n:'Команда выдохнула: качество работ подросло, выручка недобрана за паузу.'}]},
  {id:'w5', cat:'Рост', diff:1, w:6, t:'Позитивный материал в деловых СМИ',
   d:'Крупное издание выпустило позитивный материал о проекте.',
   o:[
    {l:'Развить в PR-кампанию', e:{capPct:-0.3, rep:2}, n:'Кампания развила всплеск внимания: заявки и репутация выросли, бюджет потрачен.'},
    {l:'Использовать в переговорах с клиентами', e:{capPct:0.7, rep:2}, n:'Материал приложен к коммерческим предложениям: конверсия переговоров подросла без затрат.'},
    {l:'Поблагодарить и ничего не делать', e:{}, n:'Волна прошла: внимание остыло само, но и ресурсов не потрачено.'}]},
  {id:'w6', cat:'Рост', ind:['Технологии'], diff:2, w:6, t:'Премиальный сегмент для технологии',
   d:'Пилотный заказчик готов платить премию 20% за расширенное соглашение об уровне сервиса.',
   o:[
    {l:'Запустить премиальный тариф', e:{capPct:2.0, risk:2}, n:'Премиальный тариф запущен: маржа выросла, обязательства строже — риск штрафов за простой.'},
    {l:'Премия со страхованием обязательств', e:{capPct:1.3, risk:-1, transp:2}, n:'Обязательства застрахованы: премия почти вся наша, хвостовой риск передан страховщику.'},
    {l:'Не расширять тарифную сетку', e:{}, n:'Тарифная сетка без изменений: просто и без новых обязательств.'}]},
  {id:'w7', cat:'Рост', ind:['АПК','Здравоохранение'], diff:2, w:6, t:'Запрос на франшизную модель',
   d:'Региональный оператор просит франшизу модели проекта в своём регионе.',
   o:[
    {l:'Продать франшизу с контролем качества', e:{capPct:1.5, transp:3, rep:2}, n:'Франшиза продана с регламентом: паушальный взнос и роялти, качество под контролем, репутация растёт.'},
    {l:'Совместное предприятие вместо франшизы', e:{capPct:0.8, risk:2, delay:1}, n:'СП учреждается: глубже контроль и доля, дольше запуск.'},
    {l:'Отложить экспансию', e:{}, n:'Экспансия отложена: модель дозревает, региональный спрос отдан другим.'}]},
  {id:'w8', cat:'Рост', ind:['Энергетика','Технологии'], diff:1, w:6, t:'Снижение пошлин на оборудование',
   d:'Пошлины на импортное оборудование временно снижены на 6 месяцев.',
   o:[
    {l:'Закупить плановое оборудование в окно', e:{capPct:1.1, risk:-1}, n:'Закупка в окно сэкономила на пошлинах: график не пострадал, экономия зафиксирована.'},
    {l:'Закупить впрок на следующие этапы', e:{capPct:1.4, delay:1, risk:1}, n:'Объём закуплен впрок: экономия больше, капитал заморожен в запасах.'},
    {l:'Не менять план закупок', e:{}, n:'План закупок прежний: окно использовано конкурентами, их себестоимость ниже нашей.'}]},
];

/* Учебное событие */
const TRIAL_EV:EvDef = {id:'trial', cat:'Обучение', diff:1, w:1, t:'Учебный раунд: опережение графика',
 d:'Демонстрационное событие для знакомства с интерфейсом. Проектный отчёт показал опережение графика на 2 недели — команда ждёт решения. На итоговый счёт не влияет.',
 o:[
  {l:'Запустить следующую фазу раньше срока', e:{capPct:1.2, risk:2}, n:'Ускорение дало дополнительный поток, но проверки ушли на второй план — в учебном раунде это безопасно.'},
  {l:'Сохранить текущий график', e:{capPct:0.6, transp:2}, n:'План — надёжный план: предсказуемые расходы и контроль качества.'},
  {l:'Использовать запас на углублённые проверки', e:{capPct:0.2, transp:3, risk:-2}, n:'Проверки повысили прозрачность и снизили будущие риски.'}]};

/* ================= МОДУЛЬ 1: ДЕТЕКТИВ (32 дела) ================= */
const rub = (n:number) => nf.format(Math.round(n)) + ' ₽';
const DET_VERDICTS:{id:string; label:string}[] = [
  {id:'fin', label:'Финансовые расхождения в документах'},
  {id:'demand', label:'Завышенные прогнозы спроса'},
  {id:'sched', label:'Противоречия в графике реализации'},
  {id:'supplier', label:'Критическая зависимость от подрядчика'},
  {id:'docs', label:'Неполные или просроченные документы'},
  {id:'liquid', label:'Недостаточная ликвидность и кассовый разрыв'},
  {id:'clean', label:'Проблем не обнаружено — документы согласованы'},
];
function T1(v:{n:string; ind:string; lines:number[]; skew:number; name:string}):DetCase {
  const s = v.lines.reduce((a,b)=>a+b,0);
  const bad = s + v.skew;
  return {id:'T1_'+v.n, name:v.name, industry:v.ind, diff:1,
   intro:'Досье проекта «'+v.name+'» ('+v.ind+'). Кредитный комитет просит проверить бюджет до согласования транша.',
   docs:[
    {id:'d1', title:'Смета №1 (приложение №2 к договору)', tag:'Приложение', rows:v.lines.map((x,i)=>({k:'Раздел '+(i+1), v:rub(x)})).concat([{k:'ИТОГО по смете', v:rub(s)}])},
    {id:'d2', title:'Договор подряда, раздел «Стоимость работ»', tag:'Договор', rows:[
      {k:'Стоимость работ по договору', v:rub(s)},
      {k:'Ссылка на смету', v:'Смета №1 (приложение №2)', sus:'fin', why:'Договор ссылается на смету №1, но итог сводного бюджета не совпадает с суммой этой сметы — расхождение между документами.'}]},
    {id:'d3', title:'Сводный бюджет проекта', tag:'Бюджет', rows:
      v.lines.map((x,i)=>({k:'Раздел '+(i+1), v:rub(x)})).concat([
      {k:'ИТОГО по бюджету', v:rub(bad), sus:'fin', why:'Сумма строк равна '+rub(s)+', а итог '+rub(bad)+' — расхождение '+rub(Math.abs(v.skew))+' без поясняющих строк.'},
      {k:'Непредвиденные расходы', v:'—', sus:'fin', why:'Строка пуста: куда «спрятана» разница '+rub(Math.abs(v.skew))+', в бюджете не раскрыто.'}])},
   ],
   verdicts:DET_VERDICTS, truthId:'fin',
   explain:'Проверка арифметики: сумма разделов сметы — '+rub(s)+', а итог сводного бюджета — '+rub(bad)+'. Разница '+rub(Math.abs(v.skew))+' нигде не раскрыта. Это классическое финансовое расхождение: документы проекта противоречат друг другу по суммам, и до выяснения транш рискован.',
   insight:'fin'};
}
const T1V:{n:string; ind:string; lines:number[]; skew:number; name:string}[] = [
  {n:'a', ind:'Логистика', lines:[18200000, 26400000, 9800000, 7600000], skew:3400000, name:'Складской терминал «Юг»'},
  {n:'b', ind:'Недвижимость', lines:[124000000, 210000000, 68000000], skew:-15000000, name:'ЖК «Северный луч»'},
  {n:'c', ind:'АПК', lines:[22400000, 37600000, 14500000], skew:6200000, name:'Молочный комплекс «Заря»'},
  {n:'d', ind:'Здравоохранение', lines:[31000000, 44000000, 18200000], skew:5100000, name:'Сеть клиник «Вита»'},
  {n:'e', ind:'Энергетика', lines:[58000000, 96000000, 34000000], skew:-9800000, name:'Ветропарк «Степной»'},
];
function T2(v:{n:string; ind:string; cap:string; share:string; comp:string; rev:string; price:string; qty:string; name:string}):DetCase {
  return {id:'T2_'+v.n, name:v.name, industry:v.ind, diff:2,
   intro:'Досье проекта «'+v.name+'» ('+v.ind+'). Инвестор сомневается в выручке финансовой модели.',
   docs:[
    {id:'d1', title:'Маркетинговое исследование рынка', tag:'Маркетинг', rows:[
      {k:'Ёмкость целевого сегмента', v:v.cap},
      {k:'Ожидаемая доля проекта к 3-му году', v:v.share, sus:'demand', why:'Заявленная доля несовместима с раскладом конкурентов: их суммарные доли уже занимают рынок, а «свободного» объёма под такую долю нет.'},
      {k:'Главные конкуренты, доли', v:v.comp}]},
    {id:'d2', title:'Финансовая модель (выручка)', tag:'Модель', rows:[
      {k:'Средняя цена единицы', v:v.price},
      {k:'Плановый объём продаж, год 3', v:v.qty, sus:'demand', why:'Объём продаж × цену даёт выручку, требующую долю выше заявленной в исследовании — модель противоречит и рынку, и самой себе.'},
      {k:'Выручка, год 3', v:v.rev}]},
    {id:'d3', title:'Отчёт о конкурентах', tag:'Конкуренция', rows:[
      {k:'Всего активных игроков', v:String(v.comp.split(';').length) + ' крупных'},
      {k:'Отсутствие барьеров входа', v:'Подтверждено', sus:'demand', why:'При отсутствии барьеров входа новые игроки ещё сильнее уменьшают доступный объём — прогноз доли нереалистичен.'},
      {k:'Динамика рынка', v:'Стабильная'}]},
   ],
   verdicts:DET_VERDICTS, truthId:'demand',
   explain:'Доля проекта в модели несовместима с ёмкостью рынка и долей конкурентов: продать заявленный объём ('+v.qty+') по цене '+v.price+' при таком раскладе нельзя. Это завышенный прогноз спроса — выручка финансовой модели не обоснована.',
   insight:'demand'};
}
const T2V:{n:string; ind:string; cap:string; share:string; comp:string; rev:string; price:string; qty:string; name:string}[] = [
  {n:'a', ind:'АПК', cap:'8 400 т/год', share:'62%', comp:'«Агро-1» — 34%; «Поле» — 27%; прочие — 22%', rev:'726 000 000 ₽', price:'115 000 ₽/т', qty:'6 313 т', name:'Тепличный комплекс «ГринФуд»'},
  {n:'b', ind:'Логистика', cap:'1 200 000 паллето-мест', share:'55%', comp:'«Хаб-Центр» — 38%; «Транзит» — 31%; прочие — 18%', rev:'912 000 000 ₽', price:'7 600 ₽/мес', qty:'120 000 м²', name:'Многофункциональный склад «Вектор»'},
  {n:'c', ind:'Здравоохранение', cap:'340 000 визитов/год', share:'58%', comp:'«МедЛайн» — 36%; «Поликлиника+» — 29%; прочие — 21%', rev:'544 000 000 ₽', price:'2 800 ₽/визит', qty:'194 286 визитов', name:'Клиника «Здоровье+»'},
  {n:'d', ind:'Недвижимость', cap:'900 квартир/год в районе', share:'64%', comp:'«СтройДом» — 41%; «Град» — 26%; прочие — 19%', rev:'2 340 000 000 ₽', price:'6 500 000 ₽', qty:'360 квартир', name:'ЖК «Парковый»'},
  {n:'e', ind:'Энергетика', cap:'1 800 ГВт·ч спроса региона', share:'57%', comp:'«ТеплоСеть» — 39%; «Генерация+» — 30%; прочие — 22%', rev:'798 000 000 ₽', price:'4 200 ₽/МВт·ч', qty:'190 000 МВт·ч', name:'Солнечная станция «Рассвет»'},
];
function T3(v:{n:string; ind:string; obj:string; equip:string; start:string; delivery:string; report:string; name:string}):DetCase {
  return {id:'T3_'+v.n, name:v.name, industry:v.ind, diff:2,
   intro:'Досье проекта «'+v.name+'» ('+v.ind+'). Проверьте согласованность календарного плана.',
   docs:[
    {id:'d1', title:'График реализации (сетевой план)', tag:'График', rows:[
      {k:'Монтаж '+v.obj, v:'Месяц 7–9'},
      {k:'Пусконаладка и ввод', v:v.start, sus:'sched', why:'Ввод запланирован на '+v.start+', а '+v.equip+' по договору поступает только в '+v.delivery+' — пусконаладке нечего налаживать.'},
      {k:'Вывод на проектную мощность', v:'Месяц 11'}]},
    {id:'d2', title:'Договор поставки оборудования', tag:'Договор', rows:[
      {k:'Предмет поставки', v:v.equip},
      {k:'Срок поставки', v:v.delivery, sus:'sched', why:'Поставка позже планового ввода из графика — прямое противоречие двух документов проекта.'},
      {k:'Штраф за просрочку', v:'0,1% / день, максимум 10%'}]},
    {id:'d3', title:'Отчёт о ходе работ', tag:'Отчёт', rows:[
      {k:'Готовность строительной части', v:'74%'},
      {k:'Статус инженерных сетей', v:v.report, sus:'sched', why:'Отчёт утверждает готовность сетей, тогда как график относит их монтаж к поздним месяцам — внутренняя несостыковка отчётности.'},
      {k:'Замечания заказчика', v:'Нет'}]},
   ],
   verdicts:DET_VERDICTS, truthId:'sched',
   explain:'График обещает ввод в '+v.start+', договор — поставку '+v.equip+' в '+v.delivery+', а отчёт противоречит самому графику по готовности сетей. Это противоречие в графике реализации: критический путь не согласован между документами.',
   insight:'sched'};
}
const T3V:{n:string; ind:string; obj:string; equip:string; start:string; delivery:string; report:string; name:string}[] = [
  {n:'a', ind:'Технологии', obj:'серверных залов', equip:'чиллеры и ИБП', start:'Месяц 10', delivery:'Месяц 12', report:'Готово на 80%', name:'Дата-центр «Орион»'},
  {n:'b', ind:'АПК', obj:'холодильных камер', equip:'холодильные агрегаты', start:'Месяц 8', delivery:'Месяц 11', report:'Монтаж завершён', name:'Плодоовощной комплекс «Элеватор»'},
  {n:'c', ind:'Логистика', obj:'сортировочной линии', equip:'конвейерная система', start:'Месяц 9', delivery:'Месяц 12', report:'Пусконаладка начата', name:'Логистический хаб «Транзит-2»'},
  {n:'d', ind:'Энергетика', obj:'инверторных блоков', equip:'силовые инверторы', start:'Месяц 7', delivery:'Месяц 10', report:'Сети смонтированы', name:'СЭС «Полдень»'},
  {n:'e', ind:'Здравоохранение', obj:'операционного блока', equip:'медицинское оборудование блока', start:'Месяц 9', delivery:'Месяц 12', report:'Готово к приёму', name:'Хирургический центр «МедикаПлюс»'},
];
function T4(v:{n:string; ind:string; share:number; years:number; name:string}):DetCase {
  return {id:'T4_'+v.n, name:v.name, industry:v.ind, diff:2,
   intro:'Досье проекта «'+v.name+'» ('+v.ind+'). Комитет оценивает устойчивость подрядной схемы.',
   docs:[
    {id:'d1', title:'Реестр подрядных работ', tag:'Реестр', rows:[
      {k:'Доля работ у ГК «МонолитСтрой»', v:v.share+'% всех работ', sus:'supplier', why:'Доля '+v.share+'% у одного подрядчика критична: его сбой останавливает почти весь проект.'},
      {k:'Второй подрядчик («Профиль»)', v:String(Math.max(4, 100-v.share-8))+'% работ'},
      {k:'Прочие исполнители', v:'8% работ'}]},
    {id:'d2', title:'Договор с ГК «МонолитСтрой»', tag:'Договор', rows:[
      {k:'Срок действия', v:v.years+' года с автопролонгацией', sus:'supplier', why:'Автопролонгация на '+v.years+' года фиксирует монополию подрядчика внутри проекта без пересмотра условий.'},
      {k:'Право одностороннего выхода', v:'Только через 18 месяцев'},
      {k:'Неустойка за расторжение', v:'12% от стоимости'}]},
    {id:'d3', title:'Политика закупок проекта', tag:'Регламент', rows:[
      {k:'Порог доли одного поставщика', v:'Не более 60%', sus:'supplier', why:'Собственная политика запрещает долю выше 60%, а фактически она составляет '+v.share+'% — нарушение внутреннего регламента.'},
      {k:'Обязательный тендер на объёмы свыше', v:'20 000 000 ₽'},
      {k:'Ревизия политики', v:'Раз в год'}]},
   ],
   verdicts:DET_VERDICTS, truthId:'supplier',
   explain:v.share+'% работ у одного подрядчика, договор с автопролонгацией на '+v.years+' года и выходом лишь через 18 месяцев при неустойке 12% — при этом собственная политика закупок ограничивает долю 60%. Это критическая зависимость от подрядчика.',
   insight:'supplier'};
}
const T4V:{n:string; ind:string; share:number; years:number; name:string}[] = [
  {n:'a', ind:'Недвижимость', share:87, years:3, name:'ЖК «Луговой»'},
  {n:'b', ind:'Логистика', share:82, years:3, name:'Распределительный центр «Восток»'},
  {n:'c', ind:'АПК', share:91, years:2, name:'Птицефабрика «Светлая»'},
  {n:'d', ind:'Соцсфера', share:78, years:3, name:'Школьный кампус «Смена»'},
  {n:'e', ind:'Энергетика', share:84, years:2, name:'Солнечная станция «Ясный день»'},
];
function T5(v:{n:string; ind:string; miss:string; late:string; name:string}):DetCase {
  return {id:'T5_'+v.n, name:v.name, industry:v.ind, diff:1,
   intro:'Досье проекта «'+v.name+'» ('+v.ind+'). Проверьте комплектность разрешительной документации.',
   docs:[
    {id:'d1', title:'Чек-лист разрешительной документации', tag:'Чек-лист', rows:[
      {k:'Правоустанавливающие документы', v:'В комплекте'},
      {k:v.miss, v:'Отсутствует', sus:'docs', why:'Ключевой документ из чек-листа отсутствует: без него транш не может быть выдан по регламенту.'},
      {k:'Страхование объекта', v:'В комплекте'}]},
    {id:'d2', title:'Переписка с надзорным органом', tag:'Переписка', rows:[
      {k:'Запрос органа', v:'Дополнительные сведения по объекту'},
      {k:'Статус ответа', v:v.late, sus:'docs', why:'Ответ органу просрочен против регламентного срока — риск отказа и приостановки.'},
      {k:'Назначенная проверка', v:'Через 5 недель'}]},
    {id:'d3', title:'Отчёт о готовности проекта', tag:'Отчёт', rows:[
      {k:'Общая готовность', v:'81%'},
      {k:'Разрешительная документация', v:'«Полный комплект», по данным отчёта', sus:'docs', why:'Отчёт утверждает полный комплект, тогда как чек-лист фиксирует отсутствие документа — отчётность недостоверна.'},
      {k:'Следующий этап', v:'Финансирование этапа 3'}]},
   ],
   verdicts:DET_VERDICTS, truthId:'docs',
   explain:'Ключевой документ («'+v.miss+'») отсутствует, ответ надзорному органу просрочен, а отчёт о готовности при этом утверждает «полный комплект». Это неполные и противоречивые документы: финансирование следующего этапа до закрытия пакета рискованно.',
   insight:'docs'};
}
const T5V:{n:string; ind:string; miss:string; late:string; name:string}[] = [
  {n:'a', ind:'Здравоохранение', miss:'Лицензия на медицинскую деятельность', late:'Просрочен (18 дней из 9)', name:'Поликлиника «Доверие»'},
  {n:'b', ind:'Энергетика', miss:'Разрешение на присоединение к сетям', late:'Просрочен (22 дня из 10)', name:'СЭС «Гелиос»'},
  {n:'c', ind:'Недвижимость', miss:'Разрешение на строительство очереди 2', late:'Просрочен (31 день из 15)', name:'ЖК «Тихая гавань»'},
  {n:'d', ind:'АПК', miss:'Ветеринарное заключение на корпус', late:'Просрочен (16 дней из 8)', name:'Свиноводческий комплекс «Юг»'},
  {n:'e', ind:'Логистика', miss:'Заключение пожарной безопасности склада', late:'Просрочен (27 дней из 14)', name:'Склад-холодильник «Полюс»'},
];
function T6(v:{n:string; ind:string; month:string; spend:number; inflow:number; bal:number; odl:number; name:string}):DetCase {
  const gap = v.spend - v.inflow - v.bal;
  return {id:'T6_'+v.n, name:v.name, industry:v.ind, diff:2,
   intro:'Досье проекта «'+v.name+'» ('+v.ind+'). Проверьте устойчивость кассового плана.',
   docs:[
    {id:'d1', title:'График платежей и поступлений', tag:'Кассовый план', rows:[
      {k:'Расходы, '+v.month, v:rub(v.spend)},
      {k:'Поступления, '+v.month, v:rub(v.inflow)},
      {k:'Остаток на начало месяца', v:rub(v.bal)},
      {k:'Расчётный остаток на конец месяца', v:rub(v.bal+v.inflow-v.spend)+' (дефицит '+rub(gap)+')', sus:'liquid', why:'Расходы '+rub(v.spend)+' превышают остаток и поступления на '+rub(gap)+' — кассовый разрыв без источника покрытия.'}]},
    {id:'d2', title:'Кредитный договор (лимит овердрафта)', tag:'Договор', rows:[
      {k:'Лимит овердрафта', v:rub(v.odl), sus:'liquid', why:'Лимит овердрафта ('+rub(v.odl)+') меньше разрыва ('+rub(gap)+') — покрытие недостижимо даже кредитной линией.'},
      {k:'Ставка по овердрафту', v:'Ключевая + 4,5 п.п.'}]},
    {id:'d3', title:'Пояснительная записка финансового директора', tag:'Записка', rows:[
      {k:'Заявление о ликвидности', v:'«Кассовый план сбалансирован на горизонте 12 месяцев»', sus:'liquid', why:'Записка утверждает сбалансированность, но расчёт графика показывает дефицит '+rub(gap)+' — заявление противоречит цифрам.'},
      {k:'Планируемый транш инвестора', v:'Поступит через 3 месяца — позже разрыва'}]},
   ],
   verdicts:DET_VERDICTS, truthId:'liquid',
   explain:'В '+v.month+' расходы '+rub(v.spend)+' превышают остаток и поступления на '+rub(gap)+', лимит овердрафта ('+rub(v.odl)+') разрыв не покрывает, а транш инвестора приходит позже. Это классический кассовый разрыв — недостаточная ликвидность.',
   insight:'liquid'};
}
const T6V:{n:string; ind:string; month:string; spend:number; inflow:number; bal:number; odl:number; name:string}[] = [
  {n:'a', ind:'Недвижимость', month:'месяц 4', spend:82000000, inflow:41000000, bal:12000000, odl:20000000, name:'ЖК «Заречный»'},
  {n:'b', ind:'АПК', month:'месяц 3', spend:54000000, inflow:26000000, bal:9000000, odl:14000000, name:'Птицефабрика «Нива»'},
  {n:'c', ind:'Логистика', month:'месяц 5', spend:67000000, inflow:33000000, bal:11000000, odl:16000000, name:'Терминал «Грузовой двор»'},
  {n:'d', ind:'Технологии', month:'месяц 2', spend:38000000, inflow:15000000, bal:7000000, odl:10000000, name:'ИТ-платформа «Синтез»'},
  {n:'e', ind:'Здравоохранение', month:'месяц 6', spend:49000000, inflow:27000000, bal:8000000, odl:12000000, name:'Диагностический центр «Видение»'},
];
const T7:DetCase = {id:'T7', name:'Модернизация хлебозавода «Колос»', industry:'АПК', diff:3,
 intro:'Досье сложное: в проекте спрятано несколько проблем одновременно. Найдите все подозрительные факты.',
 docs:[
  {id:'d1', title:'Инвестиционный меморандум', tag:'Меморандум', rows:[
   {k:'Бюджет проекта', v:'214 000 000 ₽'},
   {k:'Срок окупаемости', v:'2,1 года'},
   {k:'Заявленный спрос: загрузка линий', v:'96% с первого месяца', sus:'demand', why:'Мгновенная загрузка 96% без переходного периода — нереалистичный прогноз сбыта.'},
   {k:'Ключевой поставщик линии', v:'ГК «Пекармаш», единственный источник', sus:'supplier', why:'Единственный источник ключевого оборудования — критическая зависимость от поставщика.'}]},
  {id:'d2', title:'Смета и график', tag:'План', rows:[
   {k:'Смета: оборудование', v:'96 400 000 ₽'},
   {k:'Смета: строительно-монтажные работы', v:'58 200 000 ₽'},
   {k:'Смета: пусконаладка и прочее', v:'21 700 000 ₽'},
   {k:'Итого в смете', v:'188 300 000 ₽'},
   {k:'Итого в меморандуме (бюджет)', v:'214 000 000 ₽', sus:'fin', why:'Разница 25 700 000 ₽ между сметой и бюджетом не раскрыта: в смете нет строки «резервы» или «прочее» на эту сумму.'},
   {k:'Поставка линии', v:'Месяц 5'},
   {k:'Запуск производства', v:'Месяц 4', sus:'sched', why:'Запуск запланирован раньше поставки линии — прямое противоречие графика.'}]},
  {id:'d3', title:'Кассовый план (фрагмент)', tag:'Касса', rows:[
   {k:'Расходы, месяц 4 (запуск)', v:'38 500 000 ₽'},
   {k:'Поступления, месяц 4', v:'9 200 000 ₽'},
   {k:'Остаток на начало месяца 4', v:'11 000 000 ₽'},
   {k:'Остаток на конец месяца 4', v:'−18 300 000 ₽', sus:'liquid', why:'Отрицательный остаток 18,3 млн ₽ при отсутствии источника покрытия — кассовый разрыв в месяце запуска.'}]},
 ],
 verdicts:DET_VERDICTS.filter(x=>x.id!=='clean'), truthId:'fin',
 explain:'В деле несколько проблем сразу: (1) финансовое расхождение — бюджет 214 млн ₽ против суммы сметы 188,3 млн ₽; (2) завышенный спрос — загрузка 96% с первого месяца; (3) противоречие графика — запуск в месяц 4 раньше поставки линии в месяц 5; (4) кассовый разрыв −18,3 млн ₽ в месяце запуска; (5) зависимость от единственного поставщика линии. Верный первичный вердикт — финансовое расхождение (наиболее объективный документированный факт), остальные проблемы подтверждаются рядом.',
 insight:'fin'};
const T8:DetCase = {id:'T8', name:'Транспортная развязка «Северный узел»', industry:'Логистика', diff:3,
 intro:'Крупное инфраструктурное дело. Комиссия просит особую внимательность: проблем несколько.',
 docs:[
  {id:'d1', title:'Смета проекта', tag:'Смета', rows:[
   {k:'Раздел 1: земля и подготовка', v:'340 000 000 ₽'},
   {k:'Раздел 2: конструкции и дороги', v:'890 000 000 ₽'},
   {k:'Раздел 3: инженерия и освещение', v:'214 000 000 ₽'},
   {k:'Итого по разделам', v:'1 444 000 000 ₽'},
   {k:'Итого в сводной таблице', v:'1 402 000 000 ₽', sus:'fin', why:'Сводная таблица занижает итог на 42 000 000 ₽ относительно суммы разделов — арифметическое расхождение.'}]},
  {id:'d2', title:'Реестр подрядчиков и договоры', tag:'Подряд', rows:[
   {k:'Доля работ у АО «ДорСтройМост»', v:'93% всех подрядов', sus:'supplier', why:'93% подрядов у одной компании — критическая концентрация зависимости.'},
   {k:'Тендерные процедуры', v:'Проведены формально, единственный участник — то же АО', sus:'supplier', why:'Тендеры с единственным участником не создают конкурентной цены — формальность вместо выбора.'},
   {k:'Аванс подрядчику', v:'30% без банковской гарантии', sus:'fin', why:'Крупный аванс без гарантии: при срыве вернуть деньги будет крайне сложно.'}]},
  {id:'d3', title:'График и прогноз трафика', tag:'План', rows:[
   {k:'Поставка щитовых конструкций', v:'Месяц 14'},
   {k:'Монтаж надземной части', v:'Месяц 11–13', sus:'sched', why:'Монтаж конструкций запланирован раньше их поставки в месяце 14.'},
   {k:'Прогноз трафика', v:'58 000 авто/сутки'},
   {k:'Аналогичная развязка рядом (открыта в прошлом году)', v:'26 000 авто/сутки', sus:'demand', why:'Прогноз вдвое выше фактического трафика аналогичного объекта — завышенный прогноз спроса.'}]},
 ],
 verdicts:DET_VERDICTS.filter(x=>x.id!=='clean'), truthId:'supplier',
 explain:'Главный системный риск дела — концентрация зависимости: 93% подрядов у АО «ДорСтройМост», тендеры с единственным участником, аванс 30% без гарантии. Дополнительно вскрыты: арифметическое расхождение сметы (−42 млн ₽), монтаж раньше поставки конструкций и двукратное завышение прогноза трафика (58 тыс. против 26 тыс. у аналога).',
 insight:'supplier'};

const DET_LIBRARY:DetCase[] = [].concat(
  T1V.map(T1), T2V.map(T2), T3V.map(T3), T4V.map(T4), T5V.map(T5), T6V.map(T6), [T7, T8]
);
function buildCases():DetCase[] {
  const first = DET_LIBRARY[Math.floor(rng()*DET_LIBRARY.length)];
  const rest = DET_LIBRARY.filter(c => c.id.split('_')[0] !== first.id.split('_')[0]);
  return [first, rest[Math.floor(rng()*rest.length)]];
}

const TERMS:Record<string, string> = {
  'ЦФА':'Цифровые финансовые активы: цифровые права на требования, выпускаемые в информационной системе на основе распределённого реестра. В игре — демонстрационная модель.',
  'RWA':'Real World Assets — реальные активы (недвижимость, инфраструктура, оборудование), представленные в цифровой форме для учёта и оборота.',
  'Токенизация':'Представление актива в виде цифровых записей (токенов): прозрачный учёт долей и поэтапное привлечение капитала под контролем проверок.',
  'ГАНИМЕД':'Блокчейн-инфраструктура экосистемы НЕКСУС: распределённый реестр, прозрачный аудит и неизменяемость истории изменений.',
  'Дрейф':'Рыночное изменение стоимости проекта между раундами — считается по базовой доходности и волатильности стратегии.',
  'Инсайт':'Открытая в расследовании находка: даёт дополнительные варианты реагирования в кризисных раундах.',
  'Кассовый разрыв':'Ситуация, когда расходы превышают доступные средства на конкретную дату.',
  'Скоринг':'Условная оценка качества проекта по взвешенным факторам: устойчивость, спрос, документы, сроки, данные.',
  'Резерв':'Неразмещённая часть капитала: покрывает неожиданные расходы и смягчает удары событий.',
  'Волатильность':'Размах случайных колебаний стоимости: чем выше, тем сильнее события раскачивают портфель.',
};
const GLOSSARY:{q:string; a:string}[] = [
  {q:'RWA — реальные активы (Real World Assets)', a:'Материальные и финансовые активы — недвижимость, оборудование, инфраструктура, — которые можно представить в цифровой форме для учёта, аудита и оборота. В игре все проекты являются демонстрационными моделями RWA.'},
  {q:'ЦФА — цифровые финансовые активы', a:'Цифровые права на требования, выпускаемые в информационной системе на основе распределённого реестра. В игре используется упрощённая демонстрационная модель: никаких реальных выпусков цифровых активов не происходит.'},
  {q:'Зачем нужна токенизация', a:'Токенизация представляет актив в виде цифровых записей (токенов). Это повышает прозрачность, упрощает учёт долей и позволяет привлекать капитал этапами — под контролем проверок и мониторинга.'},
  {q:'Блокчейн ГАНИМЕД', a:'Инфраструктура распределённого реестра в экосистеме НЕКСУС: фиксация операций, прозрачный аудит данных и неизменяемость истории изменений. В игре ГАНИМЕД упоминается как часть модели экосистемы.'},
];
const ACH:{id:string; name:string; desc:string}[] = [
  {id:'divers', name:'Диверсификатор', desc:'3 и более отраслей в портфеле'},
  {id:'tools', name:'Полный арсенал', desc:'Использованы все 4 инструмента аналитики'},
  {id:'cold', name:'Хладнокровный', desc:'3 оптимальных решения подряд в событиях'},
  {id:'hub', name:'Строитель хаба', desc:'Модуль хаба развит до 2 уровня'},
  {id:'memos', name:'Исследователь', desc:'Изучены оба секретных меморандума'},
  {id:'capitalist', name:'Капиталист', desc:'Портфель превысил 1 100 000 ВЕ'},
  {id:'beater', name:'Обошёл Баффета', desc:'Итог выше, чем у виртуального соперника'},
  {id:'iron', name:'Под огнём', desc:'Завершена игра в стресс-режиме'},
  {id:'detective', name:'Следователь', desc:'Расследование с верным вердиктом'},
  {id:'sherlock', name:'Шерлок', desc:'Все улики найдены, без ложных меток'},
];
const LEGEND:{c:string; t:string}[] = [
  {c:'var(--acc)', t:'Рост / успех'},
  {c:'var(--warn)', t:'Риск / внимание'},
  {c:'var(--bad)', t:'Потери / негатив'},
  {c:'#8a8f7c', t:'Резерв / ожидание'},
];
const BUFFET_REPLIES:{aggr:string[]; def:string[]; mid:string[]} = {
  aggr:['Смелость ценна, когда знаешь цену решению. Посмотрим, знал ли её этот выбор.','Агрессивно. Дух мне нравится, счёт — посмотрим.'],
  def:['Сохранить капитал — тоже решение. Иногда лучшее.','Осторожность стоит денег, зато обходится дешевле ошибок.'],
  mid:['Сбалансированно. Проверим, хватит ли этого для роста.','Средний путь редко даёт рекорды — зато редко приводит и к пропастям.'],
};
const BOARD_Q:{t:string; opts:string[]; ok:number; why:string}[] = [
  {t:'Более половины размещённого капитала — в одной отрасли. Какой шаг снизит риск портфеля лучше всего?',
   opts:['Диверсифицировать между отраслями','Удвоить ставку на лидера','Перевести весь капитал в резерв'], ok:0,
   why:'Диверсификация снижает зависимость от одного сектора: негативное событие бьёт не по всему портфелю, а по его части.'},
  {t:'Зачем держать резерв, если его можно разместить под условную доходность?',
   opts:['Резерв всегда повышает доходность','Покрывать неожиданные расходы и события','Резерв нужен только для отчётности'], ok:1,
   why:'Резерв — подушка для непредвиденных расходов: он удерживает риск, когда события бьют по сметам, и спасает график.'},
  {t:'Что важнее всего проверить перед финансированием проекта?',
   opts:['Обещанную доходность','Количество сотрудников в офисе','Полноту и достоверность документов'], ok:2,
   why:'Комплексная проверка документов выявляет реальные риски до денег, а не после: это фундамент любого решения.'},
];
const PIPE_STAGES = ['Выбор проекта','Проверка документов','Анализ рисков','Цифровое представление актива','Условное финансирование','Мониторинг проекта'];
const PIPE_INFO = [
  'Портфель сформирован: выбранные проекты и распределение виртуального капитала подтверждены.',
  'Комплексная проверка: учредительные, разрешительные и финансовые документы проекта изучаются на полноту и достоверность.',
  'Система анализа инвестиционных и проектных рисков НЕКСУС оценивает сценарии и устойчивость денежного потока.',
  'Права на проект фиксируются в виде цифровых записей — демонстрационная модель токенизации актива.',
  'Виртуальный капитал распределяется по этапам реализации проекта — условное финансирование траншами.',
  'Прозрачный контроль показателей проекта включён. Далее — развитие собственного хаба экосистемы.',
];

/* ================= ИГРОВАЯ ЛОГИКА ================= */
function scoreOf(p:Project, s:StrategyId|null):number {
  const m = p.metrics;
  const base = m.fin*0.25 + m.demand*0.2 + m.docs*0.2 + (100-m.delay)*0.2 + m.data*0.15;
  return clamp(Math.round(base + stratMod(p, s)), 1, 99);
}
function stratMod(p:Project, s:StrategyId|null):number {
  if (!s) return 0;
  if (s === 'careful') return (p.transparency-70)*0.25 + (p.risk <= 35 ? 4 : 0);
  if (s === 'balanced') return Math.abs(p.risk-38) < 10 ? 2 : 0;
  return (p.industry === 'Технологии' ? 6 : 0) + (p.ret > 25 ? 2 : 0);
}
const baseVol = (s:StrategyId|null) => s === 'careful' ? 0.45 : s === 'innov' ? 1.5 : 0.9;
function driftPct(vol:number, riskExtra:number, p:Project, bonus:number):number {
  const noise = (rng()*2 - 1) * vol * 2.2;
  return p.ret/4 + noise - riskExtra*0.04 + bonus;
}
function adjustEff(e:Eff, stress:boolean, gan:number):Eff {
  const k = (stress ? 1.25 : 1) * (1 - 0.2*gan);
  const f = (v?:number) => v === undefined ? undefined : (v < 0 ? v*k : v);
  return {capPct:f(e.capPct), per100k:f(e.per100k), reservePct:f(e.reservePct), risk:e.risk, delay:e.delay, transp:e.transp, quality:e.quality, rep:e.rep};
}
function condOk(c:string|undefined, st:{reserve:number; wRisk:number; round:number; hasTech:boolean; docsLow:boolean; hiConc:boolean; rep:number}):boolean {
  if (!c) return true;
  if (c === 'lowRes') return st.reserve < 150000;
  if (c === 'hiRisk') return st.wRisk > 55;
  if (c === 'early') return st.round <= 2;
  if (c === 'late') return st.round >= 4;
  if (c === 'hasTech') return st.hasTech;
  if (c === 'docsLow') return st.docsLow;
  if (c === 'hiConc') return st.hiConc;
  if (c === 'repLow') return st.rep < 40;
  return true;
}
function resolveAffected(ev:EvDef, funded:Project[]):{list:Project[]; note?:string} {
  if (!funded.length) return {list:[]};
  if (!ev.ind) return {list:funded};
  const hit = funded.filter(p => ev.ind && ev.ind.indexOf(p.industry) >= 0);
  if (hit.length) return {list:hit};
  return {list:funded, note:'Совместимых отраслей в портфеле нет в точном смысле — рыночный фон затронул портфель в целом.'};
}
function effChanges(e:Eff, allocSum:number):{k:string; v:string; bad:boolean}[] {
  const out:{k:string; v:string; bad:boolean}[] = [];
  if (e.capPct) out.push({k:'Капитал', v:fmtSign(Math.round(allocSum*e.capPct/100)) + ' ВЕ (' + fmtNum(e.capPct) + '%)', bad:e.capPct < 0});
  if (e.per100k) out.push({k:'Капитал (по вложениям)', v:fmtSign(Math.round(e.per100k*allocSum/100000)) + ' ВЕ', bad:e.per100k < 0});
  if (e.reservePct) out.push({k:'Резерв', v:fmtNum(e.reservePct) + '%', bad:e.reservePct < 0});
  if (e.risk) out.push({k:'Индекс риска', v:fmtNum(e.risk), bad:e.risk > 0});
  if (e.delay) out.push({k:'Сроки', v:fmtNum(e.delay) + ' мес. экв.', bad:e.delay > 0});
  if (e.transp) out.push({k:'Прозрачность', v:fmtNum(e.transp), bad:e.transp < 0});
  if (e.quality) out.push({k:'Аналитика', v:fmtNum(e.quality), bad:e.quality < 0});
  if (e.rep) out.push({k:'Репутация', v:fmtNum(e.rep), bad:e.rep < 0});
  return out;
}
function plainMeaning(totalChange:number, e:Eff):string {
  const parts:string[] = [];
  parts.push(totalChange >= 0 ? 'портфель подрос' : 'портфель просел');
  if ((e.risk||0) > 0) parts.push('риск-профиль ухудшился');
  else if ((e.risk||0) < 0) parts.push('риски снизились');
  if ((e.delay||0) > 0) parts.push('сроки сдвинулись');
  else if ((e.delay||0) < 0) parts.push('график ускорился');
  if ((e.rep||0) > 0) parts.push('репутация укрепилась');
  else if ((e.rep||0) < 0) parts.push('репутация пострадала');
  if ((e.reservePct||0) > 0) parts.push('резерв укрепился');
  else if ((e.reservePct||0) < 0) parts.push('резерв истощился');
  return parts[0].charAt(0).toUpperCase() + parts[0].slice(1) + (parts.length > 1 ? ', ' + parts.slice(1).join(', ') + '.' : '.');
}
function ratingBreakdown(m:FinalMetrics):[string, number][] {
  return [
    ['Условная доходность · 35%', clamp(35 + m.growth*1.8, 0, 100)],
    ['Контроль риска · 20%', 100 - m.wRisk],
    ['Эффективность распределения · 15%', m.eff],
    ['Качество анализа · 15%', m.quality],
    ['Прозрачность решений · 15%', m.transp],
  ];
}
function buffetPick(ev:EvDef, policy:'careful'|'aggress'):number {
  let best = 0, bestU = -1e9;
  ev.o.forEach((o,i) => {
    const e = o.e;
    const gain = (e.capPct||0)*3 + (e.reservePct||0)*2 + (e.per100k||0)/50000*2 + (e.transp||0)*0.4;
    const pain = (e.risk||0)*2 + (e.delay||0)*1.2 + ((e.capPct||0) < 0 ? -e.capPct*2 : 0) + ((e.per100k||0) < 0 ? -e.per100k/50000 : 0);
    const u = policy === 'aggress' ? gain*1.6 - pain*0.5 : gain - pain*1.6;
    if (u > bestU) { bestU = u; best = i; }
  });
  return best;
}
function buffetReply(e:Eff, r:number):string {
  const aggr = (e.capPct||0) >= 1.5;
  const def = (e.capPct||0) < 0 || (e.risk||0) < 0;
  const pool = aggr ? BUFFET_REPLIES.aggr : def ? BUFFET_REPLIES.def : BUFFET_REPLIES.mid;
  return pool[r % pool.length];
}
function counterTotal(e:Eff, ctx:RoundCtx):number {
  const res = Math.max(0, ctx.reserve*(1 + (e.reservePct||0)/100));
  let cap = 0;
  ctx.ids.forEach(id => {
    const b = ctx.before[id] || 0; const g = ctx.pct[id] || 0; const a = ctx.allocs[id] || 0;
    cap += b*(1 + g/100) + b*(e.capPct||0)/100 + (e.per100k||0)*a/1e5;
  });
  return res + cap;
}
function optimalIdx(effs:Eff[], ctx:RoundCtx):number {
  let bi = 0, bv = -1;
  effs.forEach((e,i) => { const t = counterTotal(e, ctx); if (t > bv) { bv = t; bi = i; } });
  return bi;
}

/* ================= ИКОНКИ ================= */
function Icon({name, size, className}:{name:string; size?:number; className?:string}) {
  const sz = size || 20;
  const g:Record<string, React.ReactNode> = {
    sun: <g><circle cx="12" cy="12" r="4"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.6 4.6l2.1 2.1M17.3 17.3l2.1 2.1M19.4 4.6l-2.1 2.1M6.7 17.3l-2.1 2.1"/></g>,
    home: <g><path d="M3 11.5 12 4l9 7.5"/><path d="M5.5 10.5V20h13v-9.5"/><path d="M10 20v-5h4v5"/></g>,
    truck: <g><path d="M2 7h11v9H2z"/><path d="M13 10h4l3 3v3h-7"/><circle cx="6.5" cy="17.5" r="1.8"/><circle cx="16.5" cy="17.5" r="1.8"/></g>,
    wheat: <g><path d="M12 21v-6"/><path d="M12 15c-2.8 0-4.5-1.6-4.8-4.4C10 10.8 11.8 12 12 15Z"/><path d="M12 15c2.8 0 4.5-1.6 4.8-4.4C14 10.8 12.2 12 12 15Z"/><path d="M12 10c-2.5-.2-3.9-1.6-4.1-4C10.4 6.2 11.8 7.4 12 10Z"/><path d="M12 10c2.5-.2 3.9-1.6 4.1-4C13.6 6.2 12.2 7.4 12 10Z"/></g>,
    cpu: <g><rect x="7" y="7" width="10" height="10" rx="2"/><rect x="10.5" y="10.5" width="3" height="3"/><path d="M9 3v4M15 3v4M9 17v4M15 17v4M3 9h4M3 15h4M17 9h4M17 15h4"/></g>,
    school: <g><path d="M3 21h18"/><path d="M5 21V10l7-5 7 5v11"/><path d="M9.5 21v-4.5h5V21"/><path d="M12 5V3h3"/></g>,
    check: <path d="M4 12.5 9.5 18 20 6.5"/>,
    plus: <path d="M12 5v14M5 12h14"/>,
    close: <path d="M6 6l12 12M18 6 6 18"/>,
    arrow: <path d="M5 12h14M13 5l7 7-7 7"/>,
    doc: <g><path d="M7 3h7l4 4v14H7z"/><path d="M14 3v4h4"/><path d="M10 12h5M10 15.5h5"/></g>,
    shield: <g><path d="M12 3l7 2.8v5.4c0 4.6-3 7.8-7 9.8-4-2-7-5.2-7-9.8V5.8z"/><path d="M9 11.5l2.2 2.2 4.3-4.2"/></g>,
    layers: <g><path d="M12 3 3 8l9 5 9-5-9-5Z"/><path d="m3 13.5 9 5 9-5"/></g>,
    warn: <g><path d="M12 4 2.5 20h19L12 4Z"/><path d="M12 10v4.5"/><path d="M12 17.4h.01"/></g>,
    chart: <g><path d="M4 20V4"/><path d="M4 20h16"/><path d="M7.5 15l3.5-4 3 2.5L18 8"/></g>,
    bolt: <path d="M13 2 4.5 13.5H11L9.8 22l8.7-11.5H12L13 2Z"/>,
    eye: <g><path d="M2 12s3.6-6.5 10-6.5S22 12 22 12s-3.6 6.5-10 6.5S2 12 2 12Z"/><circle cx="12" cy="12" r="2.6"/></g>,
    trophy: <g><path d="M8 21h8M12 17v4M7 4h10v5a5 5 0 0 1-10 0V4Z"/><path d="M7 6H4.5A1.5 1.5 0 0 0 3 7.5C3 9.5 4.5 11 7 11M17 6h2.5A1.5 1.5 0 0 1 21 7.5C21 9.5 19.5 11 17 11"/></g>,
    search: <g><circle cx="10.5" cy="10.5" r="6.5"/><path d="M15.5 15.5 21 21"/></g>,
  };
  return <svg width={sz} height={sz} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinecap="round" strokeLinejoin="round" className={className} aria-hidden="true">{g[name] || g.doc}</svg>;
}
const LOGO_PATH = (window as any)['NEXUS_LOGO_PATH'] || '';
function Mark({size}:{size?:number}) {
  const s = size || 36;
  return <svg width={s} height={s} viewBox="0 0 160 160" aria-hidden="true" style={{display:'block', flex:'none'}}>
    <ellipse cx="80" cy="80" rx="80" ry="77.95" fill="#191919"/>
    <path fill="#F4F2F2" fillRule="evenodd" clipRule="evenodd" d={LOGO_PATH}/>
  </svg>;
}

/* ================= АТОМЫ ================= */
function Bar({v, color}:{v:number; color?:string}) {
  return <div className="bar"><i style={{width:clamp(v,0,100)+'%', background:color || 'var(--acc)'}}/></div>;
}
function Gauge({value, label, text, grad}:{value:number; label:string; text?:string; grad?:boolean}) {
  return <div className="gauge">
    <div className="gauge-top"><span>{label}</span><span className="mono gauge-v">{text !== undefined ? text : Math.round(value) + '%'}</span></div>
    <div className={'gauge-track' + (grad ? ' grad' : '')}><i className="gauge-mark" style={{left:clamp(value,0,100)+'%'}}/></div>
  </div>;
}
function Donut({parts}:{parts:{name:string; v:number; color:string}[]}) {
  const total = parts.reduce((s,p) => s+p.v, 0);
  const R = 56, C = 2*Math.PI*R; let off = 0;
  return <svg viewBox="0 0 140 140" style={{width:'100%', maxWidth:200, display:'block', margin:'0 auto'}}>
    <circle cx="70" cy="70" r={R} fill="none" stroke="#20231a" strokeWidth="14"/>
    {total > 0 && parts.map((p,i) => {
      const frac = p.v/total;
      const el = <circle key={i} className="donut-seg" cx="70" cy="70" r={R} fill="none" stroke={p.color} strokeWidth="14"
        strokeDasharray={Math.max(0, frac*C-2) + ' ' + (C - Math.max(0, frac*C-2))}
        strokeDashoffset={-off} transform="rotate(-90 70 70)"/>;
      off += frac*C; return el;
    })}
    <text x="70" y="67" textAnchor="middle" fill="#eff1e6" style={{font:'700 15px JetBrains Mono'}}>{fmtShort(total)}</text>
    <text x="70" y="85" textAnchor="middle" fill="#6f7462" style={{font:'500 8px Inter', letterSpacing:'.08em'}}>ВЕ РАЗМЕЩЕНО</text>
  </svg>;
}
function Radar({vals}:{vals:number[]}) {
  const labels = ['Финансы','Спрос','Документы','Сроки','Данные'];
  const cx = 120, cy = 102, R = 70;
  const pt = (i:number, r:number) => { const a = -Math.PI/2 + i*2*Math.PI/5; return [cx + Math.cos(a)*r, cy + Math.sin(a)*r]; };
  const ring = (f:number) => [0,1,2,3,4].map(i => pt(i, R*f).map(n => n.toFixed(1)).join(',')).join(' ');
  const data = vals.map((v,i) => pt(i, R*clamp(v,0,100)/100).map(n => n.toFixed(1)).join(',')).join(' ');
  return <svg viewBox="0 0 240 210" style={{width:'100%', maxWidth:340}}>
    {[0.25,0.5,0.75,1].map(f => <polygon key={f} points={ring(f)} fill="none" stroke="#262a1c" strokeWidth="1"/>)}
    {[0,1,2,3,4].map(i => { const p = pt(i,R); return <line key={i} x1={cx} y1={cy} x2={p[0]} y2={p[1]} stroke="#262a1c"/>; })}
    <polygon points={data} fill="rgba(205,241,56,.13)" stroke="#cdf138" strokeWidth="1.6"/>
    {vals.map((v,i) => { const p = pt(i, R*clamp(v,0,100)/100); return <circle key={i} cx={p[0]} cy={p[1]} r="3" fill="#cdf138"/>; })}
    {[0,1,2,3,4].map(i => { const p = pt(i, R+22); return <text key={i} x={p[0]} y={p[1]} textAnchor="middle" fill="#a3a894" style={{font:'500 10px Inter'}}>{labels[i]}</text>; })}
  </svg>;
}
function LineChart({data}:{data:number[]}) {
  const w = 640, h = 210, pad = 14;
  const min = Math.min.apply(null, data)*0.997, max = Math.max.apply(null, data)*1.003;
  const x = (i:number) => pad + i*(w-2*pad)/Math.max(1, data.length-1);
  const y = (v:number) => h - pad - (v-min)/((max-min) || 1)*(h-2*pad);
  const pts = data.map((v,i) => x(i).toFixed(1) + ',' + y(v).toFixed(1)).join(' ');
  const area = 'M' + x(0) + ',' + (h-pad) + ' L' + pts.split(' ').join(' L') + ' L' + x(data.length-1) + ',' + (h-pad) + ' Z';
  return <svg viewBox={'0 0 ' + w + ' ' + h} style={{width:'100%'}}>
    {[0.25,0.5,0.75].map(f => <line key={f} x1={pad} x2={w-pad} y1={pad + f*(h-2*pad)} y2={pad + f*(h-2*pad)} stroke="#22261a"/>)}
    <path d={area} fill="rgba(205,241,56,.08)"/>
    <polyline points={pts} fill="none" stroke="#cdf138" strokeWidth="2.2" strokeLinejoin="round"/>
    {data.map((v,i) => <circle key={i} cx={x(i)} cy={y(v)} r={i === data.length-1 ? 5 : 3.4} fill="#cdf138" stroke="#0a0b08" strokeWidth="2"/>)}
    <text x={pad} y={h-2} fill="#6f7462" style={{font:'500 10px Inter'}}>Старт: {fmtShort(data[0])}</text>
    <text x={w-pad} y={h-2} textAnchor="end" fill="#a3a894" style={{font:'600 10px JetBrains Mono'}}>Финал: {fmtShort(data[data.length-1])} ВЕ</text>
  </svg>;
}
function Dial({v}:{v:number}) {
  const R = 56, C = 2*Math.PI*R;
  return <div className="dial-wrap">
    <svg viewBox="0 0 140 140" style={{width:'100%', height:'100%'}}>
      <circle cx="70" cy="70" r={R} fill="none" stroke="#20231a" strokeWidth="9"/>
      <circle cx="70" cy="70" r={R} fill="none" stroke="#cdf138" strokeWidth="9" strokeLinecap="round"
        strokeDasharray={(C*clamp(v,0,100)/100) + ' ' + C} transform="rotate(-90 70 70)"/>
    </svg>
    <div className="dial-c"><b>{Math.round(v)}</b><span>баллов</span></div>
  </div>;
}
function NetworkCanvas() {
  const ref = useRef<HTMLCanvasElement|null>(null);
  useEffect(() => {
    const cv = ref.current; if (!cv) return;
    const ctx = cv.getContext('2d'); if (!ctx) return;
    let w = 0, h = 0, raf = 0, t = 0;
    const dpr = Math.min(2, window.devicePixelRatio || 1);
    const N = 26;
    const ns = Array.from({length:N}, (_,i) => ({x:Math.random(), y:Math.random(), vx:(Math.random()-.5)*.0007, vy:(Math.random()-.5)*.0007, hub:i%6 === 0, r:i%6 === 0 ? 3.4 : 1.9}));
    const rs = () => { const b = cv.getBoundingClientRect(); w = b.width; h = b.height; cv.width = Math.max(1, w*dpr); cv.height = Math.max(1, h*dpr); ctx.setTransform(dpr,0,0,dpr,0,0); };
    rs(); window.addEventListener('resize', rs);
    const step = () => {
      t++; ctx.clearRect(0,0,w,h);
      const lim = Math.min(160, w*0.24);
      for (const n of ns) { n.x += n.vx; n.y += n.vy; if (n.x < .03 || n.x > .97) n.vx *= -1; if (n.y < .06 || n.y > .94) n.vy *= -1; }
      for (let i = 0; i < N; i++) for (let j = i+1; j < N; j++) {
        const a = ns[i], b = ns[j];
        const d = Math.hypot((a.x-b.x)*w, (a.y-b.y)*h);
        if (d < lim) {
          const al = (1 - d/lim);
          ctx.strokeStyle = (a.hub || b.hub) ? 'rgba(205,241,56,' + (al*0.5) + ')' : 'rgba(150,156,138,' + (al*0.22) + ')';
          ctx.lineWidth = 1; ctx.beginPath(); ctx.moveTo(a.x*w, a.y*h); ctx.lineTo(b.x*w, b.y*h); ctx.stroke();
        }
      }
      for (const n of ns) {
        ctx.beginPath(); ctx.arc(n.x*w, n.y*h, n.r, 0, 7);
        ctx.fillStyle = n.hub ? '#cdf138' : '#878d78'; ctx.fill();
        if (n.hub) { const p = (t%150)/150; ctx.beginPath(); ctx.arc(n.x*w, n.y*h, n.r+2+p*17, 0, 7); ctx.strokeStyle = 'rgba(205,241,56,' + (0.35*(1-p)) + ')'; ctx.lineWidth = 1; ctx.stroke(); }
      }
      raf = requestAnimationFrame(step);
    };
    raf = requestAnimationFrame(step);
    const onVis = () => { cancelAnimationFrame(raf); if (!document.hidden) raf = requestAnimationFrame(step); };
    document.addEventListener('visibilitychange', onVis);
    return () => { cancelAnimationFrame(raf); window.removeEventListener('resize', rs); document.removeEventListener('visibilitychange', onVis); };
  }, []);
  return <canvas ref={ref} className="net" aria-label="Схема связей экосистемы"/>;
}

/* ================= ОБЩИЕ БЛОКИ ================= */
function StageHead({kicker, step, title, sub}:{kicker:string; step:number; title:string; sub?:string}) {
  return <div className="stage-head anim">
    <div className="chip-row">
      <span className="chip"><i className="dot"/>{kicker}</span>
      <span className="chip">Этап {step} из {STAGES.length}</span>
    </div>
    <h2>{title}</h2>
    {sub && <p className="sub">{sub}</p>}
  </div>;
}
function Modal({open, onClose, title, children}:{open:boolean; onClose:()=>void; title:string; children:React.ReactNode}) {
  useEffect(() => {
    if (!open) return;
    const h = (e:KeyboardEvent) => { if (e.key === 'Escape') onClose(); };
    window.addEventListener('keydown', h);
    return () => window.removeEventListener('keydown', h);
  }, [open]);
  if (!open) return null;
  return <div className="ovl" onClick={onClose} role="dialog" aria-modal="true">
    <div className="dlg" onClick={e => e.stopPropagation()}>
      <button type="button" className="dlg-x" onClick={onClose} aria-label="Закрыть окно"><Icon name="close" size={16}/></button>
      <h3>{title}</h3>
      {children}
    </div>
  </div>;
}
class Safe extends React.Component<{label:string; onReset:()=>void; children:React.ReactNode}, {err:Error|null}> {
  constructor(props:{label:string; onReset:()=>void; children:React.ReactNode}) { super(props); this.state = {err:null}; }
  static getDerivedStateFromError(err:Error) { return {err}; }
  render() {
    if (this.state.err) {
      const e = this.state.err;
      const msg = e && e.message ? e.message : String(e);
      const stack = e && e.stack ? String(e.stack) : '';
      return <section className="panel anim">
        <div className="stage-head">
          <div className="chip-row">
            <span className="chip bad"><i className="dot" style={{background:'var(--bad)'}}/>Сбой экрана</span>
            <span className="chip">Модуль: {this.props.label}</span>
          </div>
          <h2>Экран не отобразился</h2>
          <p className="sub">Игра не потерялась — шапка, навигация и прогресс работают. Ниже точная причина сбоя.</p>
        </div>
        <div className="warn-box r"><span><b>Ошибка:</b> {msg}</span></div>
        {stack && <pre className="errpre">{stack}</pre>}
        <div className="stage-foot">
          <button type="button" className="btn btn-ghost btn-sm" onClick={() => this.setState({err:null})}>Попробовать снова</button>
          <button type="button" className="btn btn-acc" onClick={this.props.onReset}>Начать заново</button>
        </div>
      </section>;
    }
    return this.props.children;
  }
}
function Term({t}:{t:string}) {
  const [open, setOpen] = useState(false);
  const ref = useRef<HTMLSpanElement|null>(null);
  useEffect(() => {
    if (!open) return;
    const h = (e:MouseEvent) => { if (ref.current && !ref.current.contains(e.target as Node)) setOpen(false); };
    document.addEventListener('click', h);
    return () => document.removeEventListener('click', h);
  }, [open]);
  const a = TERMS[t];
  if (!a) return <span>{t}</span>;
  return <span ref={ref} className="term" onClick={e => { e.stopPropagation(); setOpen(o => !o); }}>
    {t}
    {open && <span className="term-pop" onClick={e => e.stopPropagation()}><b>{t}</b>{a}</span>}
  </span>;
}
function Mentor({text, onHide}:{text:React.ReactNode; onHide:()=>void}) {
  return <div className="mentor">
    <span className="mentor-ava"><Mark size={30}/></span>
    <div>
      <div className="lbl" style={{marginBottom:5}}>НЕКСУС ИИ · наставник</div>
      <div className="mentor-bubble">
        {text}
        <button type="button" className="mentor-x" onClick={onHide}>Скрыть подсказки</button>
      </div>
    </div>
  </div>;
}
function LegendRow({small}:{small?:boolean}) {
  return <div className="legend-row">
    {LEGEND.map(l => <span key={l.t} className={'legend-it' + (small ? ' sm' : '')}><i style={{background:l.c}}/>{l.t}</span>)}
  </div>;
}
function MemoCard({n, title, state, onOpen, onSkip, children}:{n:number; title:string; state:MemoState; onOpen:()=>void; onSkip:()=>void; children:React.ReactNode}) {
  return <div className={'memo' + (state === 'skip' ? ' skip' : '')}>
    <div className="memo-head">
      <span className="chip acc"><i className="dot"/>Меморандум №{n}</span>
      <b>{title}</b>
      {state === 'closed' && <span style={{marginLeft:'auto', display:'flex', gap:8, alignItems:'center'}}>
        <button type="button" className="btn btn-ghost btn-sm" onClick={onOpen}><Icon name="eye" size={14}/>Открыть</button>
        <button type="button" className="qbtn" onClick={onSkip}>Пропустить</button>
      </span>}
      {state === 'open' && <span className="chip ok" style={{marginLeft:'auto'}}><Icon name="check" size={11}/>Изучено · прозрачность +3</span>}
      {state === 'skip' && <span className="chip" style={{marginLeft:'auto'}}>Пропущено</span>}
    </div>
    {state === 'open' && <div className="memo-body">{children}</div>}
  </div>;
}
function Forecast({prob, diff}:{prob:number; diff:number}) {
  const tone = prob >= 60 ? {c:'var(--bad)', t:'Повышенная вероятность негативного сценария'}
    : prob >= 40 ? {c:'var(--warn)', t:'Неопределённая конъюнктура'}
    : {c:'var(--acc)', t:'Преобладает позитивный сценарий'};
  return <div className="forecast">
    <div className="fc-head">
      <span className="cc-tag">Прогноз НЕКСУС ИИ (демо)</span>
      <span className="chip" style={{color:tone.c, borderColor:'currentColor'}}>{tone.t}</span>
      <span className="chip">Сложность: {['','низкая','средняя','высокая'][diff]}</span>
    </div>
    <div className="gauge-top" style={{marginTop:10}}><span>Вероятность негативного сценария</span><span className="mono gauge-v">{prob}%</span></div>
    <div className="gauge-track grad"><i className="gauge-mark" style={{left:prob+'%'}}/></div>
    <p className="hint" style={{marginTop:8}}>Сигнал носит вероятностный характер и не гарантирует исход раунда.</p>
  </div>;
}
function mentorNode(phase:Phase):React.ReactNode {
  switch (phase) {
    case 'intro': return <>Привет! Я — НЕКСУС ИИ, ваш наставник. Сегодня вас ждёт полный цикл: стратегия, витрина, аналитика, <b>финансовое расследование</b> и <b>кризисный симулятор</b>. Найденные в расследовании инсайты откроют дополнительные варианты в кризисных раундах.</>;
    case 'strategy': return <>Стратегия — это призма: через неё я буду оценивать проекты и события. Осторожная — контроль и проверка, Сбалансированная — сочетание отраслей, Инновационная — технологии и рост.</>;
    case 'catalog': return <>Смотрите на прозрачность: она определяет, как гладко проект пройдёт проверку. И загляните в меморандум №1 — там про документы.</>;
    case 'analytics': return <>Здесь работаю я. Четыре инструмента: радар проекта, сравнение шорт-листа, карта рисков и стресс-сценарий доходности.</>;
    case 'invest': return <>Ваше первое дело в роли следователя: открывайте документы, отмечайте подозрительные факты кликом, свяжите их и вынесите вердикт. Найденные проблемы станут <Term t="Инсайт"/>ами и откроют особые варианты в кризисных раундах.</>;
    case 'builder': return <>Распределяйте капитал ползунками. Сомневаетесь — «Предложить распределение» соберёт вариант под вашу стратегию.</>;
    case 'pipeline': return <>Проекты идут через проверку. На шагах документов и рисков выбор за вами: скорость или глубина.</>;
    case 'hub': return <>Хаб — ваша инфраструктура. Бонусы действуют все раунды симулятора. Бюджет отдельный — на портфель не влияет.</>;
    case 'trial': return <>Учебный раунд — на счёт он не влияет. Точные последствия здесь показаны для обучения — в боевых раундах они раскроются после решения.</>;
    case 'events': return <>Каждый раунд — уникальное событие, отобранное под состояние вашего портфеля. Точные последствия вариантов заранее не раскрываются — но после решения я объясню каждый эффект. Инсайты из расследования открывают дополнительные опции.</>;
    case 'results': return <>Смотрите журнал решений и «задним числом» — там весь урок. И сравните с В. Баффетом.</>;
    default: return null;
  }
}

/* ================= ЭКРАНЫ ================= */
function Intro({onStart, onRules, stress, setStress, buffetOn, setBuffetOn, seedText, setSeedText}:
  {onStart:()=>void; onRules:()=>void; stress:boolean; setStress:(v:boolean)=>void; buffetOn:boolean; setBuffetOn:(v:boolean)=>void; seedText:string; setSeedText:(v:string)=>void}) {
  return <div>
    <section className="hero">
      <div className="anim">
        <div className="chips">
          <span className="chip acc"><i className="dot"/>Демонстрационная игра</span>
          <span className="chip">Блокчейн ГАНИМЕД</span>
        </div>
        <div className="eyebrow">Платформа НЕКСУС · Инвестиционная симуляция</div>
        <h1>Стань архитектором капитала</h1>
        <p className="lead">Создай стратегию, расследуй проекты как следователь, построй портфель и проведи его через кризисный симулятор уникальных событий.</p>
        <div className="hero-btns">
          <button type="button" className="btn btn-acc" onClick={onStart}>Начать игру <Icon name="arrow" size={16}/></button>
          <button type="button" className="btn btn-ghost" onClick={onRules}>Правила игры</button>
        </div>
        <p className="hero-note">{PROJECTS.length} проектов · {DET_LIBRARY.length} детективных дел · {EVS.length} кризисных событий · {ROUNDS} раундов</p>
        <div style={{display:'flex', gap:8, flexWrap:'wrap', marginTop:12, alignItems:'center'}}>
          <button type="button" className={'chip' + (stress ? ' acc' : '')} style={{cursor:'pointer'}} onClick={() => setStress(!stress)}>{stress ? '✓ ' : ''}Стресс-портфель ×1,2</button>
          <button type="button" className={'chip' + (buffetOn ? ' acc' : '')} style={{cursor:'pointer'}} onClick={() => setBuffetOn(!buffetOn)}>{buffetOn ? '✓ ' : ''}Соперник: В. Баффет</button>
        </div>
        <div style={{marginTop:12, display:'flex', gap:8, alignItems:'center', flexWrap:'wrap'}}>
          <span className="hint">Режим воспроизведения: seed</span>
          <input className="seed-in" value={seedText} placeholder="авто" onChange={e => setSeedText(e.target.value.replace(/[^0-9]/g,''))}/>
        </div>
      </div>
      <div className="anim" style={{animationDelay:'.1s'}}>
        <div className="canvas-card">
          <div className="cc-top"><span className="cc-tag">Схема экосистемы</span><span className="chip acc">Live · демо</span></div>
          <NetworkCanvas/>
          <div className="legend">
            <span><i style={{background:'var(--acc)'}}/>Проекты</span>
            <span><i style={{background:'#878d78'}}/>Цифровая инфраструктура</span>
            <span><i style={{background:'#cdf138', borderRadius:'50%'}}/>Потоки капитала</span>
          </div>
        </div>
        <div className="mini-stats">
          <div className="ms"><b>{PROJECTS.length}</b><span>проектов</span></div>
          <div className="ms"><b>{EVS.length}</b><span>событий</span></div>
          <div className="ms"><b>{DET_LIBRARY.length}</b><span>детективных дел</span></div>
          <div className="ms"><b>0 ₽</b><span>реальных вложений</span></div>
        </div>
      </div>
    </section>
    <div className="disc-strip anim" style={{animationDelay:'.2s'}}>
      <Icon name="warn" size={17}/>
      <span>Все данные демонстрационные. Симуляция не является индивидуальной инвестиционной рекомендацией, не предполагает реальных платежей, регистрации или подключения кошелька и не гарантирует аналогичных результатов в реальных инвестициях.</span>
    </div>
  </div>;
}
function StrategyStage({sel, onSel, onNext}:{sel:StrategyId|null; onSel:(s:StrategyId)=>void; onNext:()=>void}) {
  return <section className="panel anim">
    <StageHead kicker="Инвестиционная стратегия" step={1} title="Выберите свою стратегию"
      sub="Стратегия влияет на скоринг проектов, волатильность событий и допустимую концентрацию портфеля."/>
    <div className="cards3">
      {STRATEGIES.map((s,i) => <div key={s.id} role="button" tabIndex={0} className={'card click' + (sel === s.id ? ' sel' : '')} onClick={() => onSel(s.id)}
        onKeyDown={e => { if (e.key === 'Enter') onSel(s.id); }} style={{animationDelay:(i*0.07)+'s'}}>
        <span className="chip">{s.tagline}</span>
        <h3>{s.name}</h3>
        <p className="desc">{s.desc}</p>
        <ul className="strategy-b">{s.bullets.map(b => <li key={b}><Icon name="check" size={14}/>{b}</li>)}</ul>
      </div>)}
    </div>
    <div className="stage-foot">
      <span className="hint">Выберите карточку, чтобы продолжить. Позднее стратегию нельзя будет изменить.</span>
      <button type="button" className="btn btn-acc" disabled={!sel} onClick={onNext}>Продолжить <Icon name="arrow" size={16}/></button>
    </div>
  </section>;
}
const PINS:Record<string, {x:number; y:number}> = {
  solar:{x:14,y:72}, wind:{x:18,y:50}, resid:{x:32,y:34}, soc:{x:26,y:82},
  logi:{x:54,y:20}, agro:{x:46,y:60}, green:{x:38,y:66},
  tech:{x:76,y:42}, data:{x:84,y:26}, med:{x:64,y:74},
};
function pinOf(id:string):{x:number; y:number} { const p = PINS[id]; return p ? p : {x:50, y:50}; }

function CatalogStage({shortlist, onToggle, onOpen, onNext, onBack, memoA, onMemoA}:
  {shortlist:string[]; onToggle:(id:string)=>void; onOpen:(id:string)=>void; onNext:()=>void; onBack:()=>void; memoA:MemoState; onMemoA:(s:MemoState)=>void}) {
  const docRisk = PROJECTS.filter(p => p.metrics.docs < 70).map(p => p.name);
  return <section className="panel anim">
    <StageHead kicker="Инвестиционная витрина" step={2} title="Каталог проектов"
      sub="Изучите проекты реальной экономики и добавьте интересные в шорт-лист. Нажмите на карточку для подробностей."/>
    <MemoCard n={1} title="Инвестиционный меморандум · риски документации" state={memoA}
      onOpen={() => onMemoA('open')} onSkip={() => onMemoA('skip')}>
      <span>Комплексная проверка выявила неполноту пакетов документов у проектов: <b style={{color:'var(--text)'}}>{docRisk.join(', ') || '—'}</b>. На этапе проверки возможен сдвиг сроков.</span>
      <span className="hint">Источник: демонстрационный реестр данных ГАНИМЕД.</span>
    </MemoCard>
    <div style={{display:'flex', gap:8, marginBottom:14, flexWrap:'wrap'}}>
      <span className="chip acc">В шорт-листе: {shortlist.length}</span>
      <span className="chip">Всего в каталоге: {PROJECTS.length}</span>
    </div>
    <div className="map-panel">
      <svg viewBox="0 0 100 100" preserveAspectRatio="none">
        {PROJECTS.map(p => { const pin = pinOf(p.id);
          return <line key={p.id} x1={pin.x} y1={pin.y} x2="50" y2="52" stroke={shortlist.indexOf(p.id) >= 0 ? 'rgba(205,241,56,.35)' : '#262a1c'} strokeWidth=".3"/>; })}
      </svg>
      <span className="hub-ic2" aria-hidden="true"/>
      {PROJECTS.map(p => { const pin = pinOf(p.id);
        return <button type="button" key={p.id} className={'pin' + (shortlist.indexOf(p.id) >= 0 ? ' on' : '')} style={{left:pin.x+'%', top:pin.y+'%'}} onClick={() => onOpen(p.id)}>
          <i/><span>{p.industry}</span>
        </button>; })}
      <span className="map-note">Схема размещения · демо-данные</span>
    </div>
    <div className="cards3">
      {PROJECTS.map((p,i) => {
        const band = riskBand(p.risk);
        const on = shortlist.indexOf(p.id) >= 0;
        return <div key={p.id} className={'card click' + (on ? ' sel' : '')} style={{animationDelay:(i*0.06)+'s'}} onClick={() => onOpen(p.id)} role="button" tabIndex={0}
          onKeyDown={e => { if (e.key === 'Enter') onOpen(p.id); }}>
          <div style={{display:'flex', justifyContent:'space-between', alignItems:'flex-start'}}>
            <span className="icon-tile"><Icon name={p.icon} size={22}/></span>
            <span className="chip">{p.industry}</span>
          </div>
          <h3>{p.name}</h3>
          <p className="desc">{p.desc}</p>
          <div className="meta">
            <div><span>Объём</span><b className="mono">{fmtShort(p.target)} ВЕ</b></div>
            <div><span>Срок</span><b>{p.term} мес.</b></div>
            <div><span>Индекс риска</span><b><i className="rdot" style={{background:band.c}}/>{p.risk}</b></div>
            <div><span>Прозрачность</span><b className="mono">{p.transparency}%</b></div>
          </div>
          <div className="card-foot">
            <span style={{fontSize:10.5, color:'var(--dim)', textTransform:'uppercase', letterSpacing:'.06em', display:'flex', alignItems:'center', gap:8}}>Готовность {p.readiness}%<span className="mini-bar"><i style={{width:p.readiness+'%'}}/></span></span>
            <button type="button" className="btn btn-ghost btn-sm" onClick={e => { e.stopPropagation(); onToggle(p.id); }}>{on ? 'В шорт-листе ✓' : 'В шорт-лист'}</button>
          </div>
        </div>;
      })}
    </div>
    <div className="stage-foot">
      <button type="button" className="btn btn-ghost btn-sm" onClick={onBack}>← Назад</button>
      <span className="hint">Рекомендуем 3–4 проекта из разных отраслей.</span>
      <button type="button" className="btn btn-acc" disabled={shortlist.length === 0} onClick={onNext}>Перейти к аналитике <Icon name="arrow" size={16}/></button>
    </div>
  </section>;
}
function ProjectModal({p, shortlist, onClose, onToggle}:{p:Project|null; shortlist:string[]; onClose:()=>void; onToggle:(id:string)=>void}) {
  if (!p) return null;
  const on = shortlist.indexOf(p.id) >= 0;
  const band = riskBand(p.risk);
  const m:[string, number][] = [
    ['Финансовая устойчивость', p.metrics.fin],
    ['Рыночный спрос', p.metrics.demand],
    ['Полнота документации', p.metrics.docs],
    ['Отсутствие риска задержки', 100-p.metrics.delay],
    ['Качество исходных данных', p.metrics.data],
  ];
  return <Modal open={true} onClose={onClose} title={p.name}>
    <div style={{display:'flex', gap:8, flexWrap:'wrap', marginBottom:14}}>
      <span className="chip acc"><i className="dot"/>{p.industry}</span>
      <span className="chip" style={{color:band.c, borderColor:'currentColor'}}>Индекс риска: {p.risk} · {band.label}</span>
      <span className="chip">RWA · демонстрационная модель</span>
    </div>
    <p style={{color:'var(--muted)', fontSize:14}}>{p.desc}</p>
    <div className="meta" style={{marginTop:16, gap:'10px 18px'}}>
      <div><span>Объём финансирования</span><b className="mono">{fmt(p.target)} ВЕ</b></div>
      <div><span>Срок реализации</span><b>{p.term} мес.</b></div>
      <div><span>Уровень прозрачности</span><b className="mono">{p.transparency}%</b></div>
      <div><span>Базовая доходность (демо)</span><b>≈ {p.ret}% годовых</b></div>
    </div>
    <div style={{marginTop:14}}>
      <div style={{display:'flex', justifyContent:'space-between', fontSize:12, color:'var(--muted)', marginBottom:6}}><span>Стадия готовности</span><b className="mono">{p.readiness}%</b></div>
      <Bar v={p.readiness}/>
    </div>
    <p style={{marginTop:16, fontSize:13, color:'var(--muted)', background:'#151810', border:'1px solid #22261a', borderRadius:10, padding:'11px 13px'}}>
      <b style={{color:'var(--text)'}}>Условный сценарий результата. </b>{p.scenario}
    </p>
    <div style={{marginTop:16}}>
      <div className="lbl" style={{marginBottom:8}}>Показатели для скоринга</div>
      {m.map(pair => <div key={pair[0]} className="factor">
        <span>{pair[0]}</span>
        <div className="fb"><i style={{width:pair[1]+'%'}}/></div>
        <em className="mono">{pair[1]}/100</em>
      </div>)}
    </div>
    <div style={{display:'flex', gap:10, marginTop:20, flexWrap:'wrap'}}>
      <button type="button" className="btn btn-acc" onClick={() => onToggle(p.id)}>{on ? 'Убрать из шорт-листа' : 'Добавить в шорт-лист'}</button>
      <button type="button" className="btn btn-ghost" onClick={onClose}>Закрыть</button>
    </div>
  </Modal>;
}
const TOOLS:[ToolId, string, string][] = [
  ['analyze','Анализировать проект','bolt'],
  ['compare','Сравнить проекты','chart'],
  ['risks','Показать риски','shield'],
  ['scenario','Смоделировать сценарий','layers'],
];
function AnalyticsStage({shortlist, activeId, setActive, strategyId, tools, view, onUse, onNext, onBack}:
  {shortlist:string[]; activeId:string; setActive:(id:string)=>void; strategyId:StrategyId; tools:Record<string, boolean>; view:ToolId|null; onUse:(t:ToolId)=>void; onNext:()=>void; onBack:()=>void}) {
  const p = projById(activeId);
  const score = scoreOf(p, strategyId);
  const sm = stratMod(p, strategyId);
  const sorted = [...shortlist].sort((a,b) => scoreOf(projById(b), strategyId) - scoreOf(projById(a), strategyId));
  const factors:[string, number, number][] = [
    ['Финансовая устойчивость', p.metrics.fin, 25],
    ['Рыночный спрос', p.metrics.demand, 20],
    ['Полнота документации', p.metrics.docs, 20],
    ['Отсутствие риска задержки', 100 - p.metrics.delay, 20],
    ['Качество исходных данных', p.metrics.data, 15],
  ];
  let mx = 0, mn = 0;
  factors.forEach((f,i) => { if (f[1] > factors[mx][1]) mx = i; if (f[1] < factors[mn][1]) mn = i; });
  const rank = sorted.indexOf(activeId) + 1;
  const worstRisk = [...shortlist].sort((a,b) => projById(b).risk - projById(a).risk)[0];
  const stressLoss = 100000*p.ret*0.45/100;
  return <section className="panel anim">
    <StageHead kicker="Аналитика НЕКСУС ИИ" step={3} title="Прозрачный скоринг проектов"
      sub="Демонстрационный алгоритм с открытыми весами факторов. Все расчёты выполняются локально в браузере."/>
    <div className="an-grid">
      <div>
        <div className="lbl" style={{marginBottom:9}}>Проекты шорт-листа</div>
        <div className="pick">
          {shortlist.map(id => { const pr = projById(id);
            return <button type="button" key={id} className={'pick-b' + (id === activeId ? ' on' : '')} onClick={() => setActive(id)}>
              <span style={{display:'flex', alignItems:'center', gap:9}}><span className="icon-tile" style={{width:30, height:30, borderRadius:8}}><Icon name={pr.icon} size={15}/></span>{pr.name}</span>
              <span className="sc">{scoreOf(pr, strategyId)}</span>
            </button>; })}
        </div>
        <div className="tools">
          {TOOLS.map(t => <button type="button" key={t[0]} className={'tool' + (tools[t[0]] ? ' used' : '')} onClick={() => onUse(t[0])}>
            <Icon name={t[2]} size={17}/>
            {t[1]}
            {tools[t[0]] && <span className="used-t">использовано ✓</span>}
          </button>)}
        </div>
        <p className="hint" style={{marginTop:12}}>Инструменты повышают «Качество анализа» в итогах.</p>
      </div>
      <div className="an-out">
        {view === 'analyze' && <div>
          <div style={{display:'flex', gap:20, flexWrap:'wrap', alignItems:'center'}}>
            <Radar vals={[p.metrics.fin, p.metrics.demand, p.metrics.docs, 100-p.metrics.delay, p.metrics.data]}/>
            <div style={{flex:1, minWidth:220}}>
              <span className="chip acc"><i className="dot"/>{p.name}</span>
              <div className="score-big"><b>{score}</b><span>итоговый условный скоринг / 100</span></div>
              {factors.map(f => <div key={f[0]} className="factor">
                <span>{f[0]}</span>
                <div className="fb"><i style={{width:f[1]+'%'}}/></div>
                <em className="mono">{f[1]} · {f[2]}%</em>
              </div>)}
              <div className="fact" style={{marginTop:12}}>
                <Icon name="bolt" size={14}/>
                <span>Модификатор стратегии «{STRATEGIES.filter(s => s.id === strategyId)[0].name}»: {fmtNum(Math.round(sm))}. Прозрачность {p.transparency}/100, риск {p.risk}.</span>
              </div>
              <div className="plain"><Icon name="bolt" size={14}/><span><b>Что это значит для вас:</b> сильная сторона — {factors[mx][0].toLowerCase()}, над чем работать — {factors[mn][0].toLowerCase()}. Скоринг {score} — {rank === 1 ? 'лучший в шорт-листе' : rank + '-й из ' + shortlist.length}.</span></div>
            </div>
          </div>
        </div>}
        {view === 'compare' && <div>
          <div className="cc-tag" style={{marginBottom:12}}>Сравнение проектов шорт-листа</div>
          <table className="tbl">
            <thead><tr><th>Проект</th><th>Скоринг</th><th>Риск</th><th>Прозрачность</th><th>Доходность (демо)</th></tr></thead>
            <tbody>{sorted.map((id, i) => { const pr = projById(id);
              return <tr key={id} className={id === activeId ? 'hl' : ''}>
                <td><b>{pr.name}</b>{i === 0 && <span className="chip ok" style={{marginLeft:8, fontSize:9}}>лидер</span>}</td>
                <td className="mono" style={{color:'var(--acc)', fontWeight:700}}>{scoreOf(pr, strategyId)}</td>
                <td className="mono">{pr.risk}</td>
                <td className="mono">{pr.transparency}%</td>
                <td className="mono">≈ {pr.ret}%</td>
              </tr>; })}
            </tbody>
          </table>
          <div className="plain"><Icon name="bolt" size={14}/><span><b>Что это значит для вас:</b> лидер — {projById(sorted[0]).name}. Начните сравнение долей с него, но проверьте и риск.</span></div>
        </div>}
        {view === 'risks' && <div>
          <div className="cc-tag" style={{marginBottom:12}}>Карта рисков портфеля</div>
          <div style={{display:'flex', flexDirection:'column', gap:10}}>
            {[...shortlist].sort((a,b) => projById(b).risk - projById(a).risk).map(id => { const pr = projById(id); const band = riskBand(pr.risk);
              return <div key={id} style={{background:'#151810', border:'1px solid #22261a', borderRadius:11, padding:'12px 14px'}}>
                <div style={{display:'flex', justifyContent:'space-between', alignItems:'center', gap:10, marginBottom:7, flexWrap:'wrap'}}>
                  <b style={{fontSize:13.5}}>{pr.name}</b>
                  <span className="chip" style={{color:band.c, borderColor:'currentColor'}}>{band.label} · {pr.risk}</span>
                </div>
                <ul className="strategy-b">{pr.risks.map(r => <li key={r}><Icon name="warn" size={13}/>{r}</li>)}</ul>
              </div>; })}
          </div>
          <div className="plain"><Icon name="bolt" size={14}/><span><b>Что это значит для вас:</b> самый рискованный — {projById(worstRisk).name} (индекс {projById(worstRisk).risk}). Компенсируйте прозрачностью и резервом.</span></div>
        </div>}
        {view === 'scenario' && <div>
          <div className="cc-tag" style={{marginBottom:4}}>Моделирование сценария · {p.name}</div>
          <p className="hint" style={{marginBottom:12}}>Оценка на вложение 100 000 ВЕ за 12 месяцев. Демо-модель, не прогноз.</p>
          <div className="scen3">
            {[{n:'Консервативный', r:p.ret*0.55}, {n:'Базовый', r:p.ret}, {n:'Стресс', r:-p.ret*0.45}].map(s => <div key={s.n} className="scen">
              <span>{s.n}</span>
              <b style={{color:s.r >= 0 ? 'var(--acc)' : 'var(--bad)'}}>{fmt(100000*(1+s.r/100))} ВЕ</b>
              <em style={{color:s.r >= 0 ? 'var(--muted)' : 'var(--bad)'}}>{fmtPct1(s.r)}</em>
            </div>)}
          </div>
          <div className="plain"><Icon name="bolt" size={14}/><span><b>Что это значит для вас:</b> даже в стрессе с каждых 100 000 ВЕ можно потерять до {fmt(stressLoss)} ВЕ.</span></div>
        </div>}
        {!view && <div style={{display:'flex', flexDirection:'column', alignItems:'center', justifyContent:'center', minHeight:380, gap:12, textAlign:'center'}}>
          <span className="icon-tile" style={{width:54, height:54}}><Icon name="bolt" size={26}/></span>
          <b style={{fontSize:15}}>Выберите инструмент анализа</b>
          <p className="hint" style={{maxWidth:340}}>«Анализировать проект» — радар-профиль, «Сравнить проекты» — таблица, «Показать риски» — карта угроз, «Смоделировать сценарий» — стресс-тест.</p>
        </div>}
      </div>
    </div>
    <div className="stage-foot">
      <button type="button" className="btn btn-ghost btn-sm" onClick={onBack}>← Изменить шорт-лист</button>
      <button type="button" className="btn btn-acc" onClick={onNext}>Перейти к расследованию <Icon name="arrow" size={16}/></button>
    </div>
  </section>;
}

/* ================= МОДУЛЬ 1: ДЕТЕКТИВ — рабочий стол расследования ================= */
function InvestStage({cases, caseIdx, onDone, onNextCase, onSkip}:
  {cases:DetCase[]; caseIdx:number; onDone:(score:number, insight:InsightId|null, perfect:boolean)=>void; onNextCase:()=>void; onSkip:()=>void}) {
  const c = cases[caseIdx];
  const [openDoc, setOpenDoc] = useState<string>(c.docs[0].id);
  const [flags, setFlags] = useState<Record<string, boolean>>({});
  const [verdict, setVerdict] = useState<string|null>(null);
  const [result, setResult] = useState<null | {hits:number; misses:number; total:number; ok:boolean; score:number; insight:InsightId|null; perfect:boolean}>(null);
  const doc = c.docs.filter(d => d.id === openDoc)[0] || c.docs[0];
  const totalSus = c.docs.reduce((s,d) => s + d.rows.filter(r => r.sus).length, 0);
  const flagged = Object.keys(flags).filter(k => flags[k]).length;
  const toggle = (docId:string, i:number) => {
    if (result) return;
    const key = docId + '_' + i;
    setFlags(Object.assign({}, flags, {[key]: !flags[key]}));
  };
  const finish = () => {
    if (verdict === null) return;
    let hits = 0, misses = 0;
    c.docs.forEach(d => d.rows.forEach((r,i) => {
      const key = d.id + '_' + i;
      if (flags[key]) { if (r.sus) hits++; else misses++; }
    }));
    const ok = verdict === c.truthId;
    let score = hits*10 - misses*5 + (ok ? 30 : 0);
    score = Math.max(0, score);
    const insight:InsightId|null = (ok && hits >= Math.ceil(totalSus/2)) ? c.insight : null;
    const perfect = ok && hits === totalSus && misses === 0;
    setResult({hits, misses, total:totalSus, ok, score, insight, perfect});
  };
  if (result) return <section className="panel anim">
    <StageHead kicker="Модуль 1 · Детектив" step={4} title={'Разбор дела «' + c.name + '»'}
      sub="Расследование завершено: разбор улик, вердикта и начисленные очки."/>
    <div className="ev-card">
      <div style={{display:'flex', gap:8, flexWrap:'wrap', marginBottom:12}}>
        <span className={'chip ' + (result.ok ? 'ok' : 'bad')}>{result.ok ? 'Вердикт верный' : 'Вердикт неверный'}</span>
        <span className="chip">Очки: {result.score}</span>
        <span className="chip">Улики: {result.hits}/{result.total}</span>
        {result.misses > 0 && <span className="chip bad">Ложных меток: {result.misses}</span>}
        {result.perfect && <span className="chip ok"><Icon name="trophy" size={11}/>Идеальное расследование</span>}
      </div>
      <div className="plain"><Icon name="search" size={15}/><span><b>Объяснение:</b> {c.explain}</span></div>
      <div className="det-res">
        {c.docs.map(d => d.rows.map((r,i) => {
          if (!r.sus || !r.why) return null;
          const key = d.id + '_' + i;
          const fl = !!flags[key];
          return <div key={key} className="res-row">
            <span><b style={{color:'var(--text)'}}>{d.title}</b> → {r.k}</span>
            <b className={fl ? 'hit' : 'miss'}>{fl ? 'найдено ✓' : 'пропущено'}</b>
          </div>;
        }))}
        {Object.keys(flags).filter(k => flags[k]).map(key => {
          const sep = key.lastIndexOf('_');
          const dId = key.slice(0, sep);
          const idx = parseInt(key.slice(sep+1), 10);
          const d = c.docs.filter(x => x.id === dId)[0];
          if (!d) return null;
          const r = d.rows[idx];
          if (!r || r.sus) return null;
          return <div key={'f_'+key} className="res-row"><span><b style={{color:'var(--text)'}}>{d.title}</b> → {r.k}</span><b className="miss">ложная метка −5</b></div>;
        })}
      </div>
      {result.insight && <div style={{marginTop:14}}>
        <span className="ins-chip"><Icon name="search" size={13}/>Получен инсайт: {INS_NAMES[result.insight]} — {INS_DESC[result.insight]}</span>
      </div>}
    </div>
    <div className="stage-foot">
      <button type="button" className="btn btn-acc" onClick={() => onDone(result.score, result.insight, result.perfect)}>Продолжить игру <Icon name="arrow" size={16}/></button>
      {caseIdx < cases.length - 1 && <button type="button" className="btn btn-ghost" onClick={onNextCase}>Взять ещё одно дело (факультативно)</button>}
    </div>
  </section>;
  return <section className="panel anim">
    <StageHead kicker="Модуль 1 · Детектив" step={4} title="Найди проблему в проекте"
      sub={'Дело ' + (caseIdx+1) + ' из ' + cases.length + '. Открывайте документы слева, отмечайте кликом подозрительные факты, затем выберите вердикт. Правильный ответ не раскрывается до завершения расследования.'}/>
    <div className="det-brief">
      <b style={{color:'var(--text)'}}>Досье: «{c.name}»</b> · отрасль: {c.industry} · сложность: {['','низкая','средняя','высокая'][c.diff]}<br/>
      {c.intro}
    </div>
    <div className="det-grid">
      <div>
        <div className="lbl" style={{marginBottom:9}}>Документы дела</div>
        <div style={{display:'flex', flexDirection:'column', gap:8}}>
          {c.docs.map(d => {
            const cnt = Object.keys(flags).filter(k => flags[k] && k.indexOf(d.id + '_') === 0).length;
            return <button type="button" key={d.id} className={'det-doc-b' + (d.id === openDoc ? ' on' : '')} onClick={() => setOpenDoc(d.id)}>
              <b>{d.title}</b>
              <span>{d.tag} · {d.rows.length} строк</span>
              {cnt > 0 && <span className="fl">помечено: {cnt}</span>}
            </button>;
          })}
        </div>
        <div className="hint" style={{marginTop:12}}>Помечено фактов: {flagged}. Заложено подозрительных данных — {totalSus === 1 ? 'как минимум одно' : 'несколько'}. Клик по строке — метка, повторный клик — снятие.</div>
      </div>
      <div>
        <div className="doc">
          <div className="doc-head"><b>{doc.title}</b><span>{doc.tag}</span></div>
          {doc.rows.map((r,i) => {
            const key = doc.id + '_' + i;
            const fl = !!flags[key];
            return <div key={key} className={'doc-row' + (fl ? ' flag' : '')} onClick={() => toggle(doc.id, i)} role="button" tabIndex={0}
              onKeyDown={e => { if (e.key === 'Enter') toggle(doc.id, i); }}>
              <span className="fm">{fl ? '!' : ''}</span>
              <span className="k">{r.k}</span>
              <span className="v">{r.v}</span>
            </div>;
          })}
          <p className="doc-note">Клик по строке помечает факт как подозрительный. Помечайте осмотрительно: ложные метки снижают оценку.</p>
        </div>
        <div className="verdict-box">
          <div className="lbl" style={{marginBottom:9}}>Вердикт расследования</div>
          {c.verdicts.map(v => <button type="button" key={v.id} className={'vopt' + (verdict === v.id ? ' on' : '')} onClick={() => setVerdict(v.id)}>
            {v.label}
          </button>)}
          <div style={{display:'flex', gap:10, marginTop:12, flexWrap:'wrap'}}>
            <button type="button" className="btn btn-acc" disabled={verdict === null} onClick={finish}>Вынести вердикт <Icon name="search" size={15}/></button>
            <button type="button" className="qbtn" style={{padding:'8px 16px'}} onClick={onSkip}>Пропустить расследование</button>
          </div>
        </div>
      </div>
    </div>
  </section>;
}

function BuilderStage({shortlist, alloc, setAlloc, strategyId, onConfirm, onBack, toast}:
  {shortlist:string[]; alloc:Record<string, number>; setAlloc:(a:Record<string, number>)=>void; strategyId:StrategyId; onConfirm:()=>void; onBack:()=>void; toast:(m:string)=>void}) {
  const sum = shortlist.reduce((s,id) => s + (alloc[id]||0), 0);
  const remaining = TOTAL - sum;
  const setA = (id:string, v:number) => {
    const others = shortlist.reduce((s,k) => k === id ? s : s + (alloc[k]||0), 0);
    setAlloc(Object.assign({}, alloc, {[id]: clamp(Math.round(v/10000)*10000, 0, TOTAL - others)}));
  };
  const autoDistribute = () => {
    const res:Record<string, number> = {}; shortlist.forEach(id => { res[id] = 0; });
    let rest = TOTAL, changed = true, guard = 0;
    while (rest >= 10000 && changed && guard++ < 400) {
      changed = false;
      for (const id of shortlist) {
        if (rest < 10000) break;
        const cap = Math.min(projById(id).target, TOTAL);
        if (res[id] + 10000 <= cap) { res[id] += 10000; rest -= 10000; changed = true; }
      }
    }
    setAlloc(res);
  };
  const propose = () => {
    if (!shortlist.length) return;
    const weights = shortlist.map(id => Math.max(1, scoreOf(projById(id), strategyId)));
    const sumW = weights.reduce((a,b) => a+b, 0);
    const budget = TOTAL*0.9;
    const res:Record<string, number> = {};
    shortlist.forEach((id,i) => { res[id] = Math.min(Math.floor(budget*weights[i]/sumW/10000)*10000, Math.min(projById(id).target, TOTAL)); });
    let left = budget - shortlist.reduce((s,id) => s + res[id], 0);
    let guard = 0;
    while (left >= 10000 && guard++ < 500) {
      let moved = false;
      for (const id of shortlist) {
        if (left < 10000) break;
        const cap = Math.min(projById(id).target, TOTAL);
        if (res[id] + 10000 <= cap) { res[id] += 10000; left -= 10000; moved = true; }
      }
      if (!moved) break;
    }
    setAlloc(res);
    toast('НЕКСУС ИИ предложил распределение по скорингу: 90% в портфель, 10% в резерв.');
  };
  const funded = shortlist.filter(id => (alloc[id]||0) > 0);
  const maxShare = sum > 0 ? Math.max.apply(null, funded.map(id => (alloc[id]||0)/sum)) : 0;
  const wRisk = sum > 0 ? funded.reduce((s,id) => s + (alloc[id]||0)*projById(id).risk, 0)/sum : 0;
  const conc = STRATEGIES.filter(s => s.id === strategyId)[0].conc;
  const cum = (m:number) => funded.reduce((s,id) => s + (alloc[id]||0)*(1 + projById(id).ret*m/100), 0) + remaining;
  const parts = funded.map((id,i) => ({name:projById(id).name, v:alloc[id]||0, color:['#cdf138','#93c62b','#5f8f2c','#41632f','#e6ecd4','#aab197','#7a8a5c','#5c6b4a','#93a08a'][i%9]}));
  if (remaining > 0) parts.push({name:'Резерв', v:remaining, color:'#2e3129'});
  const stratName = STRATEGIES.filter(s => s.id === strategyId)[0].name;
  return <section className="panel anim">
    <StageHead kicker="Конструктор портфеля" step={5} title="Распределите капитал"
      sub="Выделено 1 000 000 виртуальных единиц (ВЕ). Диаграмма, индикаторы и сценарии обновляются в реальном времени."/>
    <div className="bld-grid">
      <div>
        <div className="remaining">
          <div><span>Остаток капитала</span><br/><b>{fmt(remaining)} ВЕ</b></div>
          <div style={{textAlign:'right'}}><span>Размещено</span><br/><b style={{color:'var(--text)', fontSize:16}}>{fmt(sum)} ВЕ</b></div>
        </div>
        {shortlist.map(id => {
          const p = projById(id); const v = alloc[id]||0; const max = Math.min(p.target, TOTAL);
          const fillStyle:any = {['--fill']: (max ? (v/max)*100 : 0) + '%'};
          return <div key={id} className="srow">
            <div className="srow-top">
              <b style={{display:'flex', alignItems:'center', gap:8}}><i className="rdot" style={{background:riskBand(p.risk).c}}/>{p.name}</b>
              <span style={{display:'flex', alignItems:'center', gap:10}}>
                <span className="val">{fmt(v)} ВЕ</span>
                <span className="qbtns">
                  <button type="button" className="qbtn" onClick={() => setA(id, 0)}>0</button>
                  <button type="button" className="qbtn" onClick={() => setA(id, max)}>Макс</button>
                </span>
              </span>
            </div>
            <input type="range" min={0} max={max} step={10000} value={v}
              aria-label={'Доля проекта «' + p.name + '»'} style={fillStyle} onChange={e => setA(id, +e.target.value)}/>
            <div style={{display:'flex', justifyContent:'space-between', fontSize:10.5, color:'var(--dim)'}}>
              <span>Потребность проекта: {fmtShort(p.target)} ВЕ</span>
              <span>{sum > 0 && v > 0 ? 'Доля: ' + Math.round(v/sum*100) + '%' : '—'}</span>
            </div>
          </div>;
        })}
        <div style={{display:'flex', gap:8, flexWrap:'wrap'}}>
          <button type="button" className="btn btn-acc btn-sm" onClick={propose}><Icon name="bolt" size={14}/>Предложить распределение</button>
          <button type="button" className="btn btn-ghost btn-sm" onClick={autoDistribute}>Поровну по проектам</button>
          <button type="button" className="btn btn-ghost btn-sm" onClick={() => setAlloc({})}>Сбросить</button>
        </div>
      </div>
      <div>
        <div className="an-out" style={{minHeight:0}}>
          <div className="cc-tag" style={{marginBottom:10}}>Структура портфеля</div>
          <Donut parts={parts}/>
          <div className="donut-l">
            {parts.map(pt => <div key={pt.name}><i style={{background:pt.color}}/>{pt.name}<b>{sum + remaining > 0 ? Math.round(pt.v/(sum+remaining)*100) : 0}% · {fmtShort(pt.v)}</b></div>)}
          </div>
          <Gauge value={maxShare*100} label="Концентрация (макс. доля)" text={Math.round(maxShare*100) + '%'}/>
          <Gauge value={wRisk} label="Средневзвешенный индекс риска" grad text={Math.round(wRisk) + ' · ' + riskBand(wRisk).label}/>
          {maxShare*100 > conc && <div className="warn-box r"><Icon name="warn" size={15}/><span><b>Высокая концентрация.</b> {Math.round(maxShare*100)}% при пороге {conc}% для стратегии «{stratName}».</span></div>}
          {remaining/TOTAL > 0.35 && <div className="warn-box w"><Icon name="warn" size={15}/><span><b>Значительный резерв.</b> {Math.round(remaining/TOTAL*100)}% не размещено.</span></div>}
          {wRisk > 55 && <div className="warn-box w"><Icon name="warn" size={15}/><span><b>Повышенный риск.</b> Средний индекс {Math.round(wRisk)}.</span></div>}
          {maxShare*100 <= conc && remaining/TOTAL <= 0.35 && wRisk <= 55 && <div className="warn-box g"><Icon name="check" size={15}/><span><b>Структура сбалансирована.</b></span></div>}
          <div className="cc-tag" style={{marginTop:16, marginBottom:2}}>Сравнение сценариев (демо)</div>
          <div className="scen3">
            {[{n:'Консервативный', v:cum(0.7)}, {n:'Базовый', v:cum(1.25)}, {n:'Стресс', v:cum(-0.55)}].map(s => {
              const d = (s.v/TOTAL - 1)*100;
              return <div key={s.n} className="scen">
                <span>{s.n}</span>
                <b style={{color:d >= 0 ? 'var(--acc)' : 'var(--bad)'}}>{fmtShort(s.v)}</b>
                <em style={{color:d >= 0 ? 'var(--muted)' : 'var(--bad)'}}>{fmtPct1(d)}</em>
              </div>;
            })}
          </div>
        </div>
      </div>
    </div>
    <div className="stage-foot">
      <button type="button" className="btn btn-ghost btn-sm" onClick={onBack}>← Назад к расследованию</button>
      <span className="hint">Не размещённый капитал сохраняется в резерве.</span>
      <button type="button" className="btn btn-acc" disabled={sum <= 0} onClick={onConfirm}>Подтвердить распределение <Icon name="arrow" size={16}/></button>
    </div>
  </section>;
}
const HUB_MODULES:{id:string; name:string; icon:string; desc:string; bonus:(l:number)=>string}[] = [
  {id:'scoring', name:'НЕКСУС ИИ · Скоринг', icon:'bolt', desc:'Снижает волатильность рыночного дрейфа портфеля.', bonus:(l)=>'Волатильность −' + (15*l) + '%'},
  {id:'deposit', name:'Цифровой депозитарий', icon:'shield', desc:'Проверенный учёт активов повышает доверие.', bonus:(l)=>'Прозрачность +' + (2*l)},
  {id:'market', name:'Маркетплейс', icon:'chart', desc:'Доступ к площадке распределения активов.', bonus:(l)=>'Дрейф +' + (0.3*l).toString().replace('.', ',') + ' п.п.'},
  {id:'ganimed', name:'Узел ГАНИМЕД', icon:'layers', desc:'Распределённый реестр смягчает негативные события.', bonus:(l)=>'Негатив ×' + Math.round((1 - 0.2*l)*100) + '%'},
];
function PipelineStage({funded, docsLow, docsDone, riskDone, onChoose, onNext, onBack}:
  {funded:Project[]; docsLow:string[]; docsDone:boolean; riskDone:boolean; onChoose:(kind:'docs'|'risk', deep:boolean)=>void; onNext:()=>void; onBack:()=>void}) {
  const [stage, setStage] = useState(0);
  const [openFaq, setOpenFaq] = useState<number|null>(0);
  const waiting = (!docsDone && stage === 1) ? 'docs' : (!riskDone && stage === 2) ? 'risk' : null;
  useEffect(() => {
    if (stage >= 6) return;
    if (waiting) return;
    const t = window.setTimeout(() => setStage(s => s + 1), 1150);
    return () => window.clearTimeout(t);
  }, [stage, waiting]);
  return <section className="panel anim">
    <StageHead kicker="Проверка и токенизация" step={6} title="Путь проекта в экосистеме"
      sub="На шагах документов и рисков решение принимаете вы. Все операции — демонстрационные."/>
    <div className="pipe">
      {PIPE_STAGES.map((s,i) => <div key={s} className={'pnode' + (i < stage ? ' done' : i === stage ? ' act' : '')}>
        <i>{i < stage ? '✓' : i+1}</i><span>{s}</span>
      </div>)}
      <div className="pipe-line"/>
    </div>
    {!waiting && <div className="pipe-info" key={stage}>{PIPE_INFO[Math.min(stage, 5)]}</div>}
    {waiting && <div className="res-panel">
      <h4>{waiting === 'docs' ? 'Шаг проверки документов: решение за вами' : 'Шаг анализа рисков: решение за вами'}</h4>
      <p className="res-note" style={{marginTop:0}}>Выберите подход: скорость или глубина.</p>
      <div className="opts">
        {waiting === 'docs' ? [
          {label:'Подтвердить проверку пакетов', tags:['Без изменений'], deep:false},
          {label:'Запросить уточнения по документам', tags:['Прозрачность +2', 'Сроки +1'], deep:true},
        ].map(o => <button type="button" key={o.label} className="opt" onClick={() => onChoose('docs', o.deep)}>
          <b>{o.label}</b><span className="tags">{o.tags.map(t => <span key={t}>{t}</span>)}</span>
        </button>)
        : [
          {label:'Утвердить скоринг НЕКСУС ИИ', tags:['Без изменений'], deep:false},
          {label:'Расширить выборку сценариев', tags:['Аналитика +1', 'Сроки +1'], deep:true},
        ].map(o => <button type="button" key={o.label} className="opt" onClick={() => onChoose('risk', o.deep)}>
          <b>{o.label}</b><span className="tags">{o.tags.map(t => <span key={t}>{t}</span>)}</span>
        </button>)}
      </div>
    </div>}
    <div className="pstatus">
      {funded.map(p => <div key={p.id} className="pstatus-row">
        <b>{p.name}</b>
        {docsLow.indexOf(p.id) >= 0 && <span className="chip warn">Уточнение документов · срок +1</span>}
        <span className="grow"/>
        {stage >= 4 && <span className="chip acc"><i className="dot"/>ЦФА (демо) выпущен</span>}
        {stage >= 6 && <span className="chip ok"><Icon name="check" size={11}/>Мониторинг активен</span>}
        {stage < 4 && <span className="chip">Обработка…</span>}
      </div>)}
    </div>
    {stage >= 6 && <div className="res-panel">
      <h4>Проекты прошли полный цикл проверки</h4>
      <p className="res-note" style={{marginTop:0}}>Далее — развитие хаба, учебный раунд и кризисный симулятор: {ROUNDS} раундов.</p>
      <button type="button" className="btn btn-acc" style={{marginTop:14}} onClick={onNext}>Перейти к развитию хаба <Icon name="arrow" size={16}/></button>
    </div>}
    <div className="faq">
      <div className="cc-tag" style={{padding:'16px 4px 4px'}}>Простыми словами об экосистеме</div>
      {GLOSSARY.map((g,i) => <div key={g.q} className="faq-it">
        <button type="button" className={'faq-q' + (openFaq === i ? ' open' : '')} onClick={() => setOpenFaq(openFaq === i ? null : i)} aria-expanded={openFaq === i}>
          {g.q}<Icon name="plus" size={16}/>
        </button>
        {openFaq === i && <div className="faq-a">{g.a}</div>}
      </div>)}
    </div>
    <div className="stage-foot">
      <button type="button" className="btn btn-ghost btn-sm" onClick={onBack}>← Скорректировать портфель</button>
      <span className="hint">Никаких реальных юридических операций не выполняется.</span>
    </div>
  </section>;
}
function HubStage({hub, setHub, memoB, onMemoB, onNext, onBack}:
  {hub:Record<string, number>; setHub:(h:Record<string, number>)=>void; memoB:MemoState; onMemoB:(s:MemoState)=>void; onNext:()=>void; onBack:()=>void}) {
  const spent = HUB_MODULES.reduce((s,m) => s + (hub[m.id]||0), 0) * HUB_COST;
  const left = HUB_BUDGET - spent;
  const setL = (id:string, l:number) => {
    if (l < 0 || l > HUB_MAX) return;
    const others = HUB_MODULES.reduce((s,m) => m.id === id ? s : s + (hub[m.id]||0), 0);
    if ((others + l)*HUB_COST > HUB_BUDGET) return;
    setHub(Object.assign({}, hub, {[id]:l}));
  };
  const active = HUB_MODULES.filter(m => (hub[m.id]||0) > 0);
  return <section className="panel anim">
    <StageHead kicker="Развитие экосистемы" step={7} title="Собственный хаб"
      sub={'Бюджет развития: ' + fmt(HUB_BUDGET) + ' ВЕ (отдельно от портфеля), ' + fmt(HUB_COST) + ' ВЕ за уровень модуля.'}/>
    <MemoCard n={2} title="Инвестиционный меморандум · сигнал наблюдения" state={memoB}
      onOpen={() => onMemoB('open')} onSkip={() => onMemoB('skip')}>
      <span>Аналитика ГАНИМЕД (демо) предупреждает: в кризисном симуляторе события отбираются под состояние вашего портфеля. Следите за концентрацией, риском и резервом.</span>
    </MemoCard>
    <div className="remaining">
      <div><span>Остаток бюджета развития</span><br/><b>{fmt(left)} ВЕ</b></div>
      <div style={{textAlign:'right'}}><span>Вложено в хаб</span><br/><b style={{color:'var(--text)', fontSize:16}}>{fmt(spent)} ВЕ</b></div>
    </div>
    <div className="hub">
      {HUB_MODULES.map(m => {
        const lvl = hub[m.id]||0;
        return <div key={m.id} className="hub-row">
          <span className="hub-ic"><Icon name={m.icon} size={20}/></span>
          <div className="hub-info">
            <b>{m.name}</b><span>{m.desc}</span>
          </div>
          <div className="hub-ctl">
            <span className="hub-pips">{[0,1].map(i => <i key={i} className={i < lvl ? 'on' : ''}/>)}</span>
            <span className="hub-lvl">ур. {lvl}/{HUB_MAX}</span>
            <span className="qbtns">
              <button type="button" className="qbtn" onClick={() => setL(m.id, lvl-1)} disabled={lvl === 0}>−</button>
              <button type="button" className="qbtn" onClick={() => setL(m.id, lvl+1)} disabled={lvl >= HUB_MAX || left < HUB_COST}>+ {fmt(HUB_COST)}</button>
            </span>
          </div>
        </div>;
      })}
    </div>
    {active.length > 0 && <div className="hub-sum">
      {active.map(m => <span key={m.id} className="chip acc">{m.name.split('·')[0].trim()}: {m.bonus(hub[m.id]||0)}</span>)}
    </div>}
    <div className="stage-foot">
      <button type="button" className="btn btn-ghost btn-sm" onClick={onBack}>← Назад к конвейеру</button>
      <span className="hint">Можно продолжить и без вложений.</span>
      <button type="button" className="btn btn-acc" onClick={onNext}>Далее — учебный раунд <Icon name="arrow" size={16}/></button>
    </div>
  </section>;
}
function TrialStage({onDone, onSkip}:{onDone:()=>void; onSkip:()=>void}) {
  const [idx, setIdx] = useState<number|null>(null);
  const pct = 0.8;
  const eff = idx === null ? null : TRIAL_EV.o[idx].e;
  const driftV = TOTAL*pct/100;
  const evV = eff ? TOTAL*(eff.capPct||0)/100 : 0;
  const delta = driftV + evV;
  const final = TOTAL + delta;
  return <section className="panel anim">
    <StageHead kicker="Обучение" step={8} title="Пробный раунд"
      sub="Учебное событие без влияния на счёт."/>
    <div className="ev-card">
      <div style={{display:'flex', gap:8, flexWrap:'wrap', marginBottom:12}}>
        <span className="chip acc"><i className="dot"/>Учебное событие</span>
        <span className="chip">Демо-портфель: 1 000 000 ВЕ</span>
      </div>
      <div className="trial-hint"><Icon name="eye" size={14}/><span>Ниже — <b>прогноз НЕКСУС ИИ</b>. В боевых раундах он сохранится.</span></div>
      <Forecast prob={TRIAL_EV.diff*20 + 15} diff={TRIAL_EV.diff}/>
      <h3>{TRIAL_EV.t}</h3>
      <p className="desc">{TRIAL_EV.d}</p>
      <div className="trial-hint"><Icon name="eye" size={14}/><span>Точные эффекты вариантов показаны только здесь — в боевых раундах последствия раскроются после решения.</span></div>
      <div className="opts">
        {TRIAL_EV.o.map((o,i) => <button type="button" key={i} className={'opt' + (idx !== null && idx === i ? ' chosen' : '')} disabled={idx !== null} onClick={() => setIdx(i)}>
          <b>{o.l}</b>
          <span className="tags">{effChanges(o.e, TOTAL).map(c => <span key={c.k} style={c.bad ? {color:'var(--bad)', borderColor:'#4c2418'} : undefined}>{c.k} {c.v}</span>)}</span>
        </button>)}
      </div>
    </div>
    {idx !== null && eff && <div className="res-panel">
      <h4>Демо-итог: «{TRIAL_EV.o[idx].l}»</h4>
      <div className="res-row"><span>Портфель (демо)</span><b>дрейф +{fmt(driftV)} · событие {fmtSign(evV)} ВЕ</b></div>
      <div className="res-total">
        <span style={{color:'var(--muted)', fontSize:13}}>Капитал после учебного раунда</span>
        <b>{fmt(final)} ВЕ <span style={{fontSize:13, color:delta >= 0 ? 'var(--acc)' : 'var(--bad)'}}>({fmtSign(delta)})</span></b>
      </div>
      <div className="plain"><Icon name="bolt" size={14}/><span><b>Что это значит для вас:</b> {plainMeaning(delta, eff)}</span></div>
      <p className="res-note">{TRIAL_EV.o[idx].n}</p>
    </div>}
    <div className="stage-foot">
      <button type="button" className="btn btn-ghost btn-sm" onClick={onSkip}>Пропустить обучение</button>
      <span className="hint">Учебный раунд не меняет игровой капитал.</span>
      <button type="button" className="btn btn-acc" onClick={onDone}>Понятно, к игре <Icon name="arrow" size={16}/></button>
    </div>
  </section>;
}
/* ================= МОДУЛЬ 2: КРИЗИСНЫЙ СИМУЛЯТОР ================= */
function EventsStage({ev, round, log, buffet, stress, insights, onChoose, onNext}:
  {ev:EvDef; round:number; log:RoundLog|null; buffet:Buffet|null; stress:boolean; insights:InsightId[]; onChoose:(i:number)=>void; onNext:()=>void}) {
  const bChoice = buffet ? buffet.choices.filter(c => c.round === round)[0] : undefined;
  const prob = [0, 25, 50, 70][ev.diff];
  return <section className="panel anim">
    <StageHead kicker="Кризисный симулятор" step={9} title={'Раунд ' + round + ' из ' + ROUNDS}
      sub="Событие отобрано под состояние вашего портфеля: категория, совместимость отраслей, условия появления. Точные последствия раскрываются после решения — с полным объяснением."/>
    <div className="rounds">
      {Array.from({length:ROUNDS}, (_,i) => i+1).map(n => <span key={n} className={'rnd' + (n < round ? ' done' : n === round ? ' cur' : '')}>{n < round ? '✓' : n}</span>)}
    </div>
    <LegendRow small/>
    <div className="ev-card">
      <div style={{display:'flex', gap:8, flexWrap:'wrap', marginBottom:12}}>
        <span className="chip acc"><i className="dot"/>Событие · {ev.cat}</span>
        <span className="chip">{ev.ind ? 'Затрагивает: ' + ev.ind.join(' · ') : 'Затрагивает: весь портфель'}</span>
        {stress && <span className="chip bad">Стресс: негатив ×1,25 · расходы −20 000 ВЕ/раунд</span>}
      </div>
      <Forecast prob={prob} diff={ev.diff}/>
      <h3>{ev.t}</h3>
      <p className="desc">{ev.d}</p>
      <div className="opts">
        {ev.o.map((o,i) => {
          if (o.ins && insights.indexOf(o.ins) < 0) return null;
          return <button type="button" key={i} className={'opt' + (log ? (log.optI === i ? ' chosen' : '') : '')} disabled={!!log} onClick={() => onChoose(i)}>
            <b>{o.l}</b>
            {o.ins && <span className="ins-t">Открыто инсайтом: {INS_NAMES[o.ins]}</span>}
          </button>;
        })}
      </div>
    </div>
    {log && <div className="res-panel">
      <h4>Решение принято: «{ev.o[log.optI].l}»</h4>
      {log.per.map(r => <div key={r.name} className="res-row"><span>{r.name}</span><b>дрейф {fmtSign(r.drift)} · событие {fmtSign(r.ev)} ВЕ</b></div>)}
      {log.affectedNote && <p className="res-note" style={{color:'var(--warn)'}}>{log.affectedNote}</p>}
      {stress && <p className="res-note" style={{color:'var(--bad)'}}>Операционные расходы стресс-режима: −20 000 ВЕ.</p>}
      <div className="lbl" style={{marginTop:12, marginBottom:4}}>Применённые последствия</div>
      {log.ch.length === 0 && <p className="res-note">Прямых изменений показателей нет — эффект проявляется в динамике портфеля.</p>}
      {log.ch.map((c,i) => <div key={i} className="res-row"><span>{c.k}</span><b style={c.bad ? {color:'var(--bad)'} : {color:'var(--acc)'}}>{c.v}</b></div>)}
      {log.guardNote && <div className="warn-box w" style={{marginTop:10}}><Icon name="warn" size={14}/><span>{log.guardNote}</span></div>}
      <div className="plain"><Icon name="bolt" size={14}/><span><b>Почему такой результат:</b> {ev.o[log.optI].n}</span></div>
      {log.insight && <p className="res-note" style={{color:'var(--acc)'}}>Вариант открыт инсайтом из расследования — подготовка окупилась.</p>}
      {log.reply && <p className="res-note" style={{color:'var(--text)', marginTop:12}}>В. Баффет: «{log.reply}» <span style={{color:'var(--dim)'}}>(реплика соперника, шутка)</span></p>}
      {bChoice && buffet && <div className="buffet-row">
        <span>Соперник выбрал «{bChoice.label}» ({buffet.policy === 'careful' ? 'консервативная' : 'агрессивная'} стратегия)</span>
        <b>{fmt(bChoice.total)} ВЕ</b>
      </div>}
      <div className="res-total">
        <span style={{color:'var(--muted)', fontSize:13}}>Капитал портфеля после раунда</span>
        <b>{fmt(log.total)} ВЕ <span style={{fontSize:13, color:(log.drift + log.evDelta) >= 0 ? 'var(--acc)' : 'var(--bad)'}}>({fmtSign(log.drift + log.evDelta)})</span></b>
      </div>
      <button type="button" className="btn btn-acc" style={{marginTop:14}} onClick={onNext}>
        {round < ROUNDS ? 'Следующий раунд' : 'К итогам игры'} <Icon name="arrow" size={16}/>
      </button>
    </div>}
  </section>;
}
const TIERS = [
  {min:80, name:'Архитектор капитала', desc:'Максимальный контроль рисков, прозрачность и эффективность. Экосистема построена.'},
  {min:62, name:'Инвестиционный стратег', desc:'Сбалансированные решения, работа с аналитикой, расследованиями и событиями.'},
  {min:44, name:'Специалист по проектам', desc:'Уверенная работа с витриной и рисками. Есть пространство для роста.'},
  {min:0, name:'Начинающий аналитик', desc:'Вы освоили базу. Следующий шаг — активнее использовать аналитику и расследования.'},
];
function ResultsStage({m, history, logs, buffet, buffetOn, stress, ach, seed, onRestart, onDetails}:
  {m:FinalMetrics; history:number[]; logs:RoundLog[]; buffet:Buffet|null; buffetOn:boolean; stress:boolean; ach:Record<string, boolean>; seed:number; onRestart:()=>void; onDetails:()=>void}) {
  const optimalCount = logs.filter(l => optimalIdx(l.ao, l.ctx) === l.optI).length;
  const bg = buffet ? (buffet.total/TOTAL - 1)*100 : 0;
  const won = buffet ? m.growth > bg : false;
  const tie = buffet ? Math.abs(m.growth - bg) < 0.05 : false;
  const quote = tie
    ? 'Лучшее время для инвестиций — вчера. Второе по качеству — сегодня. Посмотрим в следующей партии.'
    : won
      ? 'Риск приходит от незнания того, что вы делаете. Похоже, вы знаете, что делаете.'
      : 'Правило №1: никогда не теряйте деньги. Правило №2: никогда не забывайте правило №1. Этот раунд за мной.';
  const unlockedAch = ACH.filter(a => ach[a.id]);
  return <section className="panel anim">
    <StageHead kicker="Итоги симуляции" step={10} title="Ваш итоговый рейтинг"/>
    <div className="res-grid">
      <div className="tier-card">
        <Dial v={m.total}/>
        <div className="tier">{m.tier.name}</div>
        <p>{m.tier.desc}</p>
        {stress && <span className="chip bad">Стресс-режим · ×1,2 применён</span>}
        <span className="chip acc" style={{marginTop:4}}><i className="dot"/>{m.completed} из {m.fundedCount} проектов завершено</span>
        <span className="chip">Оптимальных решений: {optimalCount} из {logs.length}</span>
        <span className="chip">Seed сессии: {seed}</span>
      </div>
      <div className="chart-card">
        <div className="cc-top">
          <span className="cc-tag">Динамика капитала по раундам</span>
          <span className="chip" style={{color:m.growth >= 0 ? 'var(--acc)' : 'var(--bad)', borderColor:'currentColor'}}>{fmtPct1(m.growth)}</span>
        </div>
        <LineChart data={history}/>
        <div className="qbars">
          <div className="qbar">
            <div className="gauge-top"><span>Качество анализа</span><span className="mono gauge-v">{m.quality}/100</span></div>
            <Bar v={m.quality}/>
          </div>
          <div className="qbar">
            <div className="gauge-top"><span>Прозрачность решений</span><span className="mono gauge-v">{m.transp}/100</span></div>
            <Bar v={m.transp}/>
          </div>
        </div>
      </div>
    </div>
    <div style={{marginTop:16}}>
      <div className="lbl" style={{marginBottom:8}}>Достижения сессии</div>
      <div style={{display:'flex', gap:8, flexWrap:'wrap'}}>
        {ACH.map(a => <span key={a.id} className={'chip' + (ach[a.id] ? ' ok' : '')} title={a.desc} style={ach[a.id] ? {} : {opacity:.45}}>
          <Icon name="trophy" size={11}/>{a.name}
        </span>)}
      </div>
      {unlockedAch.length === 0 && <p className="hint" style={{marginTop:6}}>Достижения достижимы: диверсифицируйте, используйте аналитику, расследуйте дела и держите серию оптимальных решений.</p>}
    </div>
    {buffetOn && buffet && <div className="chart-card" style={{marginTop:16}}>
      <div className="cc-top">
        <span className="cc-tag">Вы против В. Баффета (виртуальный соперник)</span>
        <span className="chip">Стратегия соперника: {buffet.policy === 'careful' ? 'консервативная' : 'агрессивная'}</span>
      </div>
      <div className="vs-grid">
        <div className="vs-num">
          <b style={{color:!tie && won ? 'var(--acc)' : 'var(--text)'}}>{fmtPct1(m.growth)}</b>
          <span>Ваш портфель · {fmt(m.finalV)} ВЕ</span>
        </div>
        <div className="vs-mid">VS</div>
        <div className="vs-num" style={{textAlign:'right'}}>
          <b style={{color:!tie && !won ? 'var(--acc)' : 'var(--text)'}}>{fmtPct1(bg)}</b>
          <span>В. Баффет · {fmt(buffet.total)} ВЕ</span>
        </div>
      </div>
      <p className="buffet-verdict">
        {tie ? 'Ничья — редкий случай.' : won ? 'Ваш портфель обошёл соперника — стратегия сработала.' : 'Соперник впереди. Загляните в журнал решений и попробуйте снова.'}
        <i>«{quote}» — реплика соперника (шутка).</i>
      </p>
    </div>}
    <div className="stats6">
      <div className="stat"><span>Начальный капитал</span><b>1 000 000 <em>ВЕ</em></b></div>
      <div className="stat"><span>Итоговый капитал</span><b style={{color:'var(--acc)'}}>{fmt(m.finalV)} <em>ВЕ</em></b></div>
      <div className="stat"><span>Изменение портфеля</span><b style={{color:m.growth >= 0 ? 'var(--acc)' : 'var(--bad)'}}>{fmtPct1(m.growth)}</b></div>
      <div className="stat"><span>Репутация</span><b>{Math.round(m.rep)} <em>/100</em></b></div>
      <div className="stat"><span>Уровень риска</span><b>{Math.round(m.wRisk)} <em style={{color:riskBand(m.wRisk).c}}>{riskBand(m.wRisk).label}</em></b></div>
      <div className="stat"><span>Эффективность распределения</span><b>{m.eff}%</b></div>
    </div>
    <div className="disc-strip" style={{marginTop:18}}>
      <Icon name="warn" size={17}/>
      <span>Результат симуляции не гарантирует аналогичных результатов в реальных инвестициях и не является индивидуальной инвестиционной рекомендацией. Использовался только виртуальный капитал.</span>
    </div>
    <div className="stage-foot">
      <button type="button" className="btn btn-acc" onClick={onRestart}>Играть заново</button>
      <button type="button" className="btn btn-ghost" onClick={onDetails}>Посмотреть результаты</button>
      <a className="btn btn-ghost" href="https://nexus-invest.fund" target="_blank" rel="noopener">Изучить экосистему НЕКСУС <Icon name="arrow" size={15}/></a>
    </div>
  </section>;
}

/* ================= ПРИЛОЖЕНИЕ ================= */
function App() {
  const [phase, setPhase] = useState<Phase>('intro');
  const [strategyId, setStrategyId] = useState<StrategyId|null>(null);
  const [shortlist, setShortlist] = useState<string[]>([]);
  const [activeId, setActiveId] = useState('solar');
  const [toolView, setToolView] = useState<ToolId|null>(null);
  const [tools, setTools] = useState<Record<string, boolean>>({});
  const [alloc, setAlloc] = useState<Record<string, number>>({});
  const [values, setValues] = useState<Record<string, number>>({});
  const [reserve, setReserve] = useState(0);
  const [delays, setDelays] = useState<Record<string, number>>({});
  const [riskExtra, setRiskExtra] = useState(0);
  const [transpExtra, setTranspExtra] = useState(0);
  const [qualityExtra, setQualityExtra] = useState(0);
  const [round, setRound] = useState(1);
  const [evQueue, setEvQueue] = useState<EvDef[]>([]);
  const [logs, setLogs] = useState<RoundLog[]>([]);
  const [history, setHistory] = useState<number[]>([TOTAL]);
  const [stress, setStress] = useState(false);
  const [buffetOn, setBuffetOn] = useState(true);
  const [buffet, setBuffet] = useState<Buffet|null>(null);
  const [hub, setHub] = useState<Record<string, number>>({});
  const [memos, setMemos] = useState<{a:MemoState; b:MemoState}>({a:'closed', b:'closed'});
  const [ach, setAch] = useState<Record<string, boolean>>({});
  const [streak, setStreak] = useState(0);
  const [pipeDone, setPipeDone] = useState<{docs:boolean; risk:boolean}>({docs:false, risk:false});
  const [board, setBoard] = useState<{t:string; opts:string[]; ok:number; why:string; answered:number|null}|null>(null);
  const [hideTips, setHideTips] = useState(false);
  const [modal, setModal] = useState<{type:string; id?:string}|null>(null);
  const [toast, setToast] = useState<string|null>(null);
  const [achToast, setAchToast] = useState<string|null>(null);
  const [seedText, setSeedText] = useState('');
  const [seed, setSeed] = useState(0);
  const [insights, setInsights] = useState<InsightId[]>([]);
  const [detCases, setDetCases] = useState<DetCase[]>([]);
  const [detIdx, setDetIdx] = useState(0);
  const [detScore, setDetScore] = useState(0);
  const [rep, setRep] = useState(50);
  const tRef = useRef(0);

  const showToast = (msg:string) => { setAchToast(null); setToast(msg); window.clearTimeout(tRef.current); tRef.current = window.setTimeout(() => setToast(null), 3200); };
  const showAch = (msg:string) => { setToast(null); setAchToast(msg); window.clearTimeout(tRef.current); tRef.current = window.setTimeout(() => setAchToast(null), 3400); };
  const award = (id:string) => {
    setAch(prev => {
      if (prev[id]) return prev;
      const def = ACH.filter(a => a.id === id)[0];
      if (def) showAch('Достижение разблокировано: ' + def.name);
      const nx = Object.assign({}, prev); nx[id] = true; return nx;
    });
  };
  useEffect(() => { try { window.scrollTo(0, 0); } catch (e) {} }, [phase]);

  const fundedLive = PROJECTS.filter(p => (values[p.id]||0) > 0);
  const totalValue = fundedLive.reduce((s,p) => s + (values[p.id]||0), 0) + reserve;
  const capital = (phase === 'events' || phase === 'results') ? totalValue : TOTAL;
  const memoBonus = (memos.a === 'open' ? 1 : 0) + (memos.b === 'open' ? 1 : 0);
  const hubSpent = HUB_MODULES.reduce((s,m) => s + (hub[m.id]||0), 0) * HUB_COST;

  /* Seed применяется синхронно до первого использования генератора */
  const startGame = () => {
    const parsed = parseInt(seedText, 10);
    const s = seedText.trim() !== '' && !isNaN(parsed) ? parsed : Date.now() % 2147483647;
    setSeed(s);
    rng = mulberry32(s);
    setDetCases(buildCases());
    setPhase('strategy');
  };

  const toggleShort = (id:string) => setShortlist(s => s.indexOf(id) >= 0 ? s.filter(x => x !== id) : s.concat([id]));
  const goAnalytics = () => { if (!shortlist.length) { showToast('Добавьте в шорт-лист хотя бы один проект'); return; } setActiveId(shortlist[0]); setPhase('analytics'); };
  const useTool = (t:ToolId) => {
    const nx = Object.assign({}, tools); nx[t] = true;
    setTools(nx); setToolView(t);
    if (TOOLS.every(x => nx[x[0]])) award('tools');
  };
  const setMemoState = (k:'a'|'b', s:MemoState) => {
    const nx = {a:memos.a, b:memos.b}; nx[k] = s;
    setMemos(nx);
    if (nx.a === 'open' && nx.b === 'open') award('memos');
  };
  const setHubLvl = (h:Record<string, number>) => {
    setHub(h);
    if (HUB_MODULES.some(m => (h[m.id]||0) >= HUB_MAX)) award('hub');
  };
  const handlePipeChoice = (kind:'docs'|'risk', deep:boolean) => {
    const bump = () => setDelays(d => { const nd = Object.assign({}, d); Object.keys(values).forEach(id => { nd[id] = (nd[id]||0) + 1; }); return nd; });
    if (kind === 'docs') {
      if (deep) { setTranspExtra(t => t + 2); bump(); showToast('Уточнения запрошены: прозрачность +2, сроки +1.'); }
      else showToast('Проверка подтверждена: движемся по графику.');
    } else {
      if (deep) { setQualityExtra(q => q + 1); bump(); showToast('Выборка расширена: аналитика +1, сроки +1.'); }
      else showToast('Скоринг утверждён: движемся по графику.');
    }
    setPipeDone(prev => { const nx = {docs:prev.docs, risk:prev.risk}; nx[kind] = true; return nx; });
  };
  const detFinish = (score:number, ins:InsightId|null, perfect:boolean) => {
    setDetScore(prev => prev + score);
    if (ins) award('detective');
    if (perfect) award('sherlock');
    if (ins && insights.indexOf(ins) < 0) setInsights(prev => prev.concat([ins]));
    setPhase('builder');
  };
  const commitAlloc = () => {
    const sum = shortlist.reduce((s,id) => s + (alloc[id]||0), 0);
    if (sum <= 0) { showToast('Распределите хотя бы часть капитала между проектами'); return; }
    const vals:Record<string, number> = {}; const dl:Record<string, number> = {};
    shortlist.forEach(id => { if ((alloc[id]||0) > 0) { vals[id] = alloc[id]; dl[id] = projById(id).metrics.docs < 70 ? 1 : 0; } });
    const inds = new Set(Object.keys(vals).map(id => projById(id).industry));
    if (inds.size >= 3) award('divers');
    setValues(vals); setReserve(TOTAL - sum); setDelays(dl);
    setPhase('pipeline');
  };
  const openBoard = () => {
    const sum = shortlist.reduce((s,id) => s + (alloc[id]||0), 0);
    if (sum <= 0) { showToast('Распределите хотя бы часть капитала между проектами'); return; }
    const fundedIds = shortlist.filter(id => (alloc[id]||0) > 0);
    const byInd:Record<string, number> = {};
    fundedIds.forEach(id => { const ind = projById(id).industry; byInd[ind] = (byInd[ind]||0) + (alloc[id]||0); });
    let maxInd = 0;
    Object.keys(byInd).forEach(k => { if (byInd[k] > maxInd) maxInd = byInd[k]; });
    let q = BOARD_Q[0];
    if (!(fundedIds.length > 0 && maxInd/sum > 0.55)) q = BOARD_Q[1 + (Math.round(sum/100000) % 2)];
    setBoard({t:q.t, opts:q.opts, ok:q.ok, why:q.why, answered:null});
  };
  const answerBoard = (i:number) => {
    if (!board || board.answered !== null) return;
    setBoard(Object.assign({}, board, {answered:i}));
    if (i === board.ok) { setQualityExtra(q => q + 2); showToast('Верно! +2 к качеству анализа.'); }
  };
  const closeBoard = () => { setBoard(null); commitAlloc(); };
  const initBuffet = ():Buffet => {
    const policy:'careful'|'aggress' = rng() < 0.5 ? 'careful' : 'aggress';
    const top = [...PROJECTS].sort((a,b) => scoreOf(b, null) - scoreOf(a, null)).slice(0, 4);
    const vals:Record<string, number> = {}; top.forEach(p => { vals[p.id] = 250000; });
    return {policy, vals, riskExtra:0, total:TOTAL, choices:[]};
  };
  /* Динамический выбор событий: совместимость + условия + исключение повторов + взвешенная выборка */
  const buildQueue = ():EvDef[] => {
    const used = new Set<string>();
    const q:EvDef[] = [];
    const docsLowAny = Object.keys(values).some(id => projById(id).metrics.docs < 70);
    for (let r = 1; r <= ROUNDS; r++) {
      const st = {reserve:reserve, wRisk:riskExtra, round:r, hasTech:fundedLive.some(p => p.industry === 'Технологии'), docsLow:docsLowAny, hiConc:false, rep:rep};
      let pool = EVS.filter(e => !used.has(e.id)
        && (!e.ind || fundedLive.some(p => e.ind && e.ind.indexOf(p.industry) >= 0))
        && condOk(e.cond, st));
      if (pool.length < 2) pool = EVS.filter(e => !used.has(e.id) && (!e.ind || fundedLive.some(p => e.ind && e.ind.indexOf(p.industry) >= 0)));
      if (!pool.length) pool = EVS.filter(e => !used.has(e.id));
      const ev = pickWeighted(pool, e => e.w / (1 + e.diff*0.35));
      if (ev) { q.push(ev); used.add(ev.id); }
    }
    return q;
  };
  const startEvents = () => {
    setRound(1); setLogs([]); setHistory([totalValue || TOTAL]);
    setBuffet(buffetOn ? initBuffet() : null);
    setEvQueue(buildQueue());
    setPhase('events');
  };
  const chooseOption = (ev:EvDef, i:number) => {
    const opt = ev.o[i];
    const effsAdj = ev.o.map(o => adjustEff(o.e, stress, hub.ganimed||0));
    const eff = effsAdj[i];
    const res = resolveAffected(ev, fundedLive);
    const affected = res.list; const affectedNote = res.note;
    const baseReserve = stress ? Math.max(0, reserve - 20000) : reserve;
    /* Условие исполнения: при нехватке резерва эффект усечён вдвое */
    let guardNote:string|undefined;
    let applied = eff;
    if (opt.guardRes !== undefined && baseReserve < opt.guardRes) {
      applied = {
        capPct: eff.capPct !== undefined ? eff.capPct*0.5 : undefined,
        per100k: eff.per100k,
        reservePct: eff.reservePct !== undefined ? eff.reservePct*0.5 : undefined,
        risk: eff.risk, delay: eff.delay, transp: eff.transp, quality: eff.quality, rep: eff.rep,
      };
      guardNote = 'Резерва не хватило для полной реализации замысла: эффект оказался вдвое слабее запланированного. Условие успеха — резерв не меньше ' + fmt(opt.guardRes) + ' ВЕ.';
    }
    const newValues = Object.assign({}, values);
    const before:Record<string, number> = {}; const pct:Record<string, number> = {}; const allocs:Record<string, number> = {};
    const ids:string[] = [];
    let driftSum = 0, evSum = 0;
    const vol = baseVol(strategyId) * (stress ? 1.3 : 1) * (1 - 0.15*(hub.scoring||0));
    const mkt = 0.3*(hub.market||0);
    const per = affected.map(p => {
      const a = alloc[p.id] || 0;
      const b = newValues[p.id] !== undefined ? newValues[p.id] : a;
      const g = driftPct(vol, riskExtra, p, mkt + (strategyId === 'innov' && p.industry === 'Технологии' ? 0.6 : 0));
      const after = Math.max(0, b*(1 + g/100) + b*(applied.capPct||0)/100 + (applied.per100k||0)*a/1e5);
      newValues[p.id] = after;
      before[p.id] = b; pct[p.id] = g; allocs[p.id] = a; ids.push(p.id);
      driftSum += b*g/100;
      evSum += after - (b + b*g/100);
      return {name:p.name, drift:Math.round(b*g/100), ev:Math.round(after - (b + b*g/100))};
    });
    const dRes = baseReserve*(applied.reservePct||0)/100;
    const newReserve = Math.max(0, baseReserve + dRes);
    const affCap = affected.reduce((s,p) => s + (values[p.id] !== undefined ? values[p.id] : (alloc[p.id]||0)), 0);
    const ch = effChanges(applied, affCap);
    setValues(newValues);
    setReserve(newReserve);
    setRiskExtra(r => clamp(r + (applied.risk||0), -25, 60));
    setTranspExtra(t => t + (applied.transp||0));
    setQualityExtra(q => q + (applied.quality||0));
    setRep(rv => clamp(rv + (applied.rep||0), 0, 100));
    if (applied.delay) setDelays(d => { const nd = Object.assign({}, d); affected.forEach(p => { nd[p.id] = (nd[p.id] || 0) + (applied.delay || 0); }); return nd; });
    const newTotal = Object.keys(newValues).reduce((s,k) => s + newValues[k], 0) + newReserve;
    const ctxObj:RoundCtx = {reserve:baseReserve, ids, before, pct, allocs};
    const oi = optimalIdx(effsAdj, ctxObj);
    const ns = (oi === i) ? streak + 1 : 0;
    setStreak(ns);
    if (ns >= 3) award('cold');
    if (newTotal > TOTAL*1.1) award('capitalist');
    const reply = (buffetOn && buffet) ? buffetReply(applied, round) : '';
    setLogs(l => l.concat([{round, ev, optI:i, applied, ao:effsAdj, ch, drift:Math.round(driftSum), evDelta:Math.round(evSum + dRes), total:newTotal, per, guardNote, insight:!!opt.ins, affectedNote, ctx:ctxObj, reply}]));
    setHistory(h => h.concat([newTotal]));
    if (buffetOn && buffet) {
      const bi = buffetPick(ev, buffet.policy);
      const bopt = ev.o[bi];
      const bProjects = PROJECTS.filter(p => (buffet.vals[p.id]||0) > 0);
      const bres = resolveAffected(ev, bProjects);
      const bVals = Object.assign({}, buffet.vals); let bTotal = 0;
      bres.list.forEach(p => {
        const a = buffet.vals[p.id] || 0;
        const g = driftPct(0.9, buffet.riskExtra, p, 0);
        const after = Math.max(0, a*(1 + g/100) + a*(bopt.e.capPct||0)/100 + (bopt.e.per100k||0)*a/1e5);
        bVals[p.id] = after; bTotal += after;
      });
      setBuffet(Object.assign({}, buffet, {vals:bVals, riskExtra:clamp(buffet.riskExtra + (bopt.e.risk||0), -25, 60), total:bTotal, choices:buffet.choices.concat([{round, label:bopt.l, total:bTotal}])}));
    }
  };
  const nextRound = () => { if (round >= ROUNDS) setPhase('results'); else setRound(round + 1); };
  const restart = () => {
    setPhase('intro'); setStrategyId(null); setShortlist([]); setToolView(null); setTools({});
    setAlloc({}); setValues({}); setReserve(0); setDelays({});
    setRiskExtra(0); setTranspExtra(0); setQualityExtra(0);
    setRound(1); setEvQueue([]); setLogs([]); setHistory([TOTAL]);
    setStress(false); setBuffetOn(true); setBuffet(null); setHub({}); setMemos({a:'closed', b:'closed'});
    setAch({}); setStreak(0); setPipeDone({docs:false, risk:false}); setBoard(null); setModal(null);
    setInsights([]); setDetCases([]); setDetIdx(0); setDetScore(0); setRep(50); setSeedText('');
  };
  useEffect(() => {
    if (phase !== 'results') return;
    if (stress) award('iron');
    if (buffetOn && buffet) {
      const bg = (buffet.total/TOTAL - 1)*100;
      const fv = fundedLive.reduce((s,p) => s + (values[p.id]||0), 0) + reserve;
      if ((fv/TOTAL - 1)*100 > bg) award('beater');
    }
  }, [phase]);

  /* итоговые метрики */
  const finalV = fundedLive.reduce((s,p) => s + (values[p.id]||0), 0) + reserve;
  const growth = (finalV/TOTAL - 1)*100;
  const sumA = fundedLive.reduce((s,p) => s + (alloc[p.id]||0), 0) || 1;
  const wRisk = clamp(fundedLive.reduce((s,p) => s + (alloc[p.id]||0)*p.risk, 0)/sumA + riskExtra, 0, 100);
  const maxShare = fundedLive.length ? Math.max.apply(null, fundedLive.map(p => (alloc[p.id]||0)/sumA)) : 0;
  const reserveShare = reserve/TOTAL;
  const effScore = clamp(Math.round(100 - maxShare*50 - reserveShare*35 - (fundedLive.length === 1 ? 10 : 0)), 0, 100);
  const toolsUsed = Object.keys(tools).filter(k => tools[k]).length;
  const quality = clamp(Math.round(30 + toolsUsed*13 + qualityExtra + insights.length*3 + clamp(Math.round(detScore/12), 0, 8) + (hub.scoring||0)*2), 0, 100);
  const avgT = fundedLive.length ? fundedLive.reduce((s,p) => s + p.transparency, 0)/fundedLive.length : 0;
  const transp = clamp(Math.round(avgT*0.72 + transpExtra + (hub.deposit||0)*2 + memoBonus*3 + (tools.risks ? 4 : 0)), 0, 100);
  const completed = fundedLive.filter(p => p.readiness + (p.transparency-70)*0.2 - (delays[p.id]||0)*5 - p.risk*0.2 >= 50).length;
  const growthScore = clamp(35 + growth*1.8, 0, 100);
  let totalScore = clamp(0.35*growthScore + 0.2*(100-wRisk) + 0.15*effScore + 0.15*quality + 0.15*transp + Math.min(9, completed*1.5) + clamp((rep-50)/10, -5, 5), 0, 100);
  if (stress) totalScore = clamp(totalScore*1.2, 0, 100);
  const m:FinalMetrics = {total:totalScore, finalV, growth, completed, fundedCount:fundedLive.length, wRisk, eff:effScore, quality, transp, rep, tier:TIERS.filter(t => totalScore >= t.min)[0], toolsUsed};

  const idx = PHASE_IDX[phase] !== undefined ? PHASE_IDX[phase] : -1;
  const footerBars = [
    {t:'Этапы игры', v:(idx+1)/STAGES.length*100},
    {t:'Инструменты аналитики', v:toolsUsed/4*100},
    {t:'Инсайты расследований', v:insights.length/6*100},
    {t:'Раунды симулятора', v:logs.length/ROUNDS*100},
  ];

  return <div>
    <header className="hdr">
      <div className="wrap hdr-in">
        <a className="logo" href="#" onClick={e => e.preventDefault()} aria-label="НЕКСУС — на начало">
          <Mark/>
          <span className="logo-t">НЕКСУС<small>АРХИТЕКТОР КАПИТАЛА</small></span>
        </a>
        {idx >= 0 && <nav className="steps" aria-label="Этапы игры">
          {STAGES.map((s,i) => <span key={s} className={'step' + (i === idx ? ' cur' : i < idx ? ' done' : '')}><i/>{s}</span>)}
        </nav>}
        {idx >= 0 && <span className="step-m">Этап {idx+1}/{STAGES.length} · {STAGES[idx]}</span>}
        <div className="hdr-r">
          {stress && idx >= 0 && <span className="chip bad">Стресс</span>}
          <span className="cap mono" title="Виртуальный капитал"><CapVal v={capital}/> <em>ВЕ</em></span>
          <button type="button" className="btn btn-ghost btn-sm" onClick={() => setModal({type:'glossary'})}>Словарь</button>
          <button type="button" className="btn btn-ghost btn-sm" onClick={() => setModal({type:'rules'})}>Правила</button>
        </div>
      </div>
    </header>

    <main className="wrap">
      {!hideTips && <Mentor text={mentorNode(phase)} onHide={() => setHideTips(true)}/>}
      {phase === 'intro' && <Safe key="intro" label="Стартовый экран" onReset={restart}><Intro onStart={startGame} onRules={() => setModal({type:'rules'})} stress={stress} setStress={setStress} buffetOn={buffetOn} setBuffetOn={setBuffetOn} seedText={seedText} setSeedText={setSeedText}/></Safe>}
      {phase === 'strategy' && <Safe key="strategy" label="Выбор стратегии" onReset={restart}><StrategyStage sel={strategyId} onSel={setStrategyId} onNext={() => setPhase('catalog')}/></Safe>}
      {phase === 'catalog' && <Safe key="catalog" label="Инвестиционная витрина" onReset={restart}><CatalogStage shortlist={shortlist} onToggle={toggleShort} onOpen={id => setModal({type:'project', id})} onNext={goAnalytics} onBack={() => setPhase('strategy')} memoA={memos.a} onMemoA={s => setMemoState('a', s)}/></Safe>}
      {phase === 'analytics' && <Safe key="analytics" label="Аналитика НЕКСУС ИИ" onReset={restart}><AnalyticsStage shortlist={shortlist} activeId={activeId} setActive={setActiveId} strategyId={strategyId || 'balanced'} tools={tools} view={toolView} onUse={useTool} onNext={() => setPhase('invest')} onBack={() => setPhase('catalog')}/></Safe>}
      {phase === 'invest' && detCases.length > 0 && <Safe key={'invest'+detIdx} label="Расследование (детектив)" onReset={restart}>
        <InvestStage cases={detCases} caseIdx={detIdx}
          onDone={detFinish}
          onNextCase={() => setDetIdx(detIdx + 1)}
          onSkip={() => { if (detIdx < detCases.length - 1) setDetIdx(detIdx + 1); else setPhase('builder'); }}/>
      </Safe>}
      {phase === 'builder' && <Safe key="builder" label="Конструктор портфеля" onReset={restart}><BuilderStage shortlist={shortlist} alloc={alloc} setAlloc={setAlloc} strategyId={strategyId || 'balanced'} onConfirm={openBoard} onBack={() => setPhase('invest')} toast={showToast}/></Safe>}
      {phase === 'pipeline' && <Safe key="pipeline" label="Проверка и токенизация" onReset={restart}><PipelineStage funded={Object.keys(values).map(projById)} docsLow={Object.keys(values).filter(id => projById(id).metrics.docs < 70)} docsDone={pipeDone.docs} riskDone={pipeDone.risk} onChoose={handlePipeChoice} onNext={() => setPhase('hub')} onBack={() => setPhase('builder')}/></Safe>}
      {phase === 'hub' && <Safe key="hub" label="Собственный хаб" onReset={restart}><HubStage hub={hub} setHub={setHubLvl} memoB={memos.b} onMemoB={s => setMemoState('b', s)} onNext={() => setPhase('trial')} onBack={() => setPhase('pipeline')}/></Safe>}
      {phase === 'trial' && <Safe key="trial" label="Учебный раунд" onReset={restart}><TrialStage onDone={startEvents} onSkip={startEvents}/></Safe>}
      {phase === 'events' && evQueue.length > 0 && <Safe key={'events'+round} label="Кризисный симулятор" onReset={restart}>
        <EventsStage ev={evQueue[round-1]} round={round} log={logs.filter(l => l.round === round)[0] || null} buffet={buffet} stress={stress} insights={insights} onChoose={i => chooseOption(evQueue[round-1], i)} onNext={nextRound}/>
      </Safe>}
      {phase === 'results' && <Safe key="results" label="Итоги симуляции" onReset={restart}><ResultsStage m={m} history={history} logs={logs} buffet={buffet} buffetOn={buffetOn} stress={stress} ach={ach} seed={seed} onRestart={restart} onDetails={() => setModal({type:'details'})}/></Safe>}
    </main>

    <footer>
      <div className="wrap">
        <div className="ft">
          <div>
            <div className="logo" style={{marginBottom:12}}><Mark/><span className="logo-t">НЕКСУС<small>АРХИТЕКТОР КАПИТАЛА</small></span></div>
            <p>Демонстрационная игра по мотивам экосистемы НЕКСУС: расследования проектов, кризисный симулятор и распределение капитала через цифровые активы.</p>
          </div>
          <div>
            <h5>Модули игры</h5>
            <ul>{STAGES.map((s,i) => <li key={s}>{i+1}. {s}</li>)}</ul>
          </div>
          <div>
            <h5>Прогресс сессии</h5>
            {footerBars.map(b => <div key={b.t} className="pb">
              <div className="pb-t"><span>{b.t}</span><span className="mono">{Math.round(clamp(b.v,0,100))}%</span></div>
              <Bar v={b.v}/>
            </div>)}
            <h5 style={{marginTop:16}}>Ресурсы</h5>
            <ul>
              <li><a href="https://nexus-invest.fund" target="_blank" rel="noopener">Сайт НЕКСУС ↗</a></li>
              <li><button type="button" onClick={() => setModal({type:'rules'})}>Правила игры</button></li>
              <li><button type="button" onClick={() => setModal({type:'glossary'})}>Словарь терминов</button></li>
              <li><button type="button" onClick={() => setModal({type:'disclaimer'})}>Правовая информация</button></li>
            </ul>
          </div>
        </div>
        <div className="ft-btm">
          <span>© 2026 Демонстрационный проект. Не является офертой или индивидуальной инвестиционной рекомендацией.</span>
          <span>Виртуальный капитал · Без платежей и регистрации</span>
        </div>
      </div>
    </footer>

    {hideTips && <button type="button" className="tips-fab chip" onClick={() => setHideTips(false)}><Icon name="eye" size={13}/>Подсказки</button>}

    <ProjectModal p={modal && modal.type === 'project' && modal.id ? projById(modal.id) : null} shortlist={shortlist} onClose={() => setModal(null)} onToggle={toggleShort}/>

    <Modal open={!!modal && modal.type === 'rules'} onClose={() => setModal(null)} title="Правила игры">
      <div style={{display:'flex', flexDirection:'column', gap:14, color:'var(--muted)', fontSize:13.5}}>
        <p><b style={{color:'var(--text)'}}>Цель.</b> Расследовать проекты, построить портфель и провести его через {ROUNDS} раундов кризисного симулятора, получив итоговый рейтинг.</p>
        <div>
          <b style={{color:'var(--text)'}}>Десять этапов:</b>
          <ul style={{margin:'8px 0 0 18px', display:'flex', flexDirection:'column', gap:5}}>
            <li>Стратегия — призма скоринга и волатильности.</li>
            <li>Витрина — {PROJECTS.length} проектов, шорт-лист.</li>
            <li>Аналитика — четыре демо-инструмента НЕКСУС ИИ.</li>
            <li><b>Расследование (детектив)</b> — {DET_LIBRARY.length} дел: документы, улики, вердикт. Найденные проблемы становятся инсайтами.</li>
            <li>Портфель — 1 000 000 ВЕ, пресет от НЕКСУС ИИ, совет директоров.</li>
            <li>Токенизация — конвейер с микро-решениями.</li>
            <li>Хаб — 100 000 ВЕ в модули с пассивными бонусами.</li>
            <li>Обучение — пробный раунд без влияния на счёт.</li>
            <li><b>Кризисный симулятор</b> — {ROUNDS} раунда из {EVS.length} событий: динамический отбор под портфель, условия появления, скрытые последствия, инсайт-опции.</li>
            <li>Итоги — рейтинг, достижения, журнал, seed сессии.</li>
          </ul>
        </div>
        <p><b style={{color:'var(--text)'}}>Связь модулей.</b> Верные вердикты в детективе дают инсайты ({Object.keys(INS_NAMES).length} типов): соответствующие кризисные события получают дополнительные, более выгодные варианты реагирования.</p>
        <p><b style={{color:'var(--text)'}}>Случайность.</b> Обычная игра — новая последовательность. Режим воспроизведения: введите seed на старте — вся сессия (дела, события, дрейфы) воспроизведётся детерминированно. Seed отображается в итогах.</p>
        <p><b style={{color:'var(--text)'}}>Капитал.</b> 1 100 000 виртуальных единиц суммарно (портфель + хаб). Они не имеют ценности.</p>
        <div className="disc-strip" style={{marginTop:4}}><Icon name="warn" size={16}/><span>Симуляция не является индивидуальной инвестиционной рекомендацией и не гарантирует аналогичных результатов в реальных инвестициях. В. Баффет — виртуальный соперник с вымышленной стратегией.</span></div>
        <button type="button" className="btn btn-acc" style={{alignSelf:'flex-start'}} onClick={() => setModal(null)}>Понятно, продолжить</button>
      </div>
    </Modal>

    <Modal open={!!modal && modal.type === 'glossary'} onClose={() => setModal(null)} title="Словарь терминов">
      <div style={{display:'flex', flexDirection:'column', gap:12, color:'var(--muted)', fontSize:13.5}}>
        {Object.keys(TERMS).map(k => <p key={k}><b style={{color:'var(--acc)'}}>{k}.</b> {TERMS[k]}</p>)}
        {GLOSSARY.map(g => <p key={g.q}><b style={{color:'var(--text)'}}>{g.q}.</b> {g.a}</p>)}
        <button type="button" className="btn btn-ghost" style={{alignSelf:'flex-start'}} onClick={() => setModal(null)}>Закрыть</button>
      </div>
    </Modal>

    <Modal open={!!modal && modal.type === 'disclaimer'} onClose={() => setModal(null)} title="Правовая информация">
      <div style={{display:'flex', flexDirection:'column', gap:12, color:'var(--muted)', fontSize:13.5}}>
        <p>Игра «НЕКСУС — Архитектор капитала» — демонстрационное образовательное приложение. Все проекты, документы, суммы, события и рейтинги вымышлены.</p>
        <p>Симуляция не является индивидуальной инвестиционной рекомендацией, офертой или обещанием доходности. Результаты симуляции не гарантируют аналогичных результатов в реальных инвестициях и не являются гарантией сохранности капитала.</p>
        <p>Не используются реальные платежи, кошельки, персональные данные и выпуски цифровых активов. Официальные названия продуктов — НЕКСУС, ГАНИМЕД, НЕКСУС ИИ — используются как обозначения экосистемы. «В. Баффет» — виртуальный соперник с вымышленной стратегией; реплики носят шутливый характер.</p>
        <button type="button" className="btn btn-ghost" style={{alignSelf:'flex-start'}} onClick={() => setModal(null)}>Закрыть</button>
      </div>
    </Modal>

    <Modal open={!!board} onClose={closeBoard} title="Совет директоров">
      {board && <div style={{display:'flex', flexDirection:'column', gap:14}}>
        <p style={{color:'var(--muted)', fontSize:14}}><b style={{color:'var(--text)'}}>Вопрос совета.</b> {board.t}</p>
        {board.answered === null && <div className="opts" style={{marginTop:0}}>
          {board.opts.map((o,i) => <button type="button" key={o} className="opt" onClick={() => answerBoard(i)}><b>{o}</b></button>)}
        </div>}
        {board.answered !== null && <div>
          {board.answered === board.ok
            ? <span className="chip ok"><Icon name="check" size={11}/>Верно · +2 к качеству анализа</span>
            : <span className="chip bad">Не в этот раз · без штрафа</span>}
          <div className="plain"><Icon name={board.answered === board.ok ? 'check' : 'warn'} size={14}/><span>{board.why}</span></div>
        </div>}
        <div style={{display:'flex', gap:10, flexWrap:'wrap'}}>
          {board.answered !== null
            ? <button type="button" className="btn btn-acc" onClick={closeBoard}>Перейти к проверке и токенизации <Icon name="arrow" size={15}/></button>
            : <button type="button" className="qbtn" style={{padding:'8px 16px'}} onClick={closeBoard}>Ответить позже (без бонуса) и продолжить</button>}
        </div>
      </div>}
    </Modal>

    <Modal open={!!modal && modal.type === 'details'} onClose={() => setModal(null)} title={'Подробные результаты · seed ' + seed}>
      <div className="cc-tag" style={{marginBottom:10}}>Seed сессии для режима воспроизведения: {seed}</div>
      <div className="cc-tag" style={{marginBottom:10}}>Портфель по проектам</div>
      <table className="tbl">
        <thead><tr><th>Проект</th><th>Распределено</th><th>Итог</th><th>Δ</th><th>Статус</th></tr></thead>
        <tbody>
          {fundedLive.map(p => {
            const a = alloc[p.id]||0; const v = values[p.id]||0; const d = (v/a - 1)*100;
            const done = p.readiness + (p.transparency-70)*0.2 - (delays[p.id]||0)*5 - p.risk*0.2 >= 50;
            return <tr key={p.id}>
              <td><b>{p.name}</b></td>
              <td className="mono">{fmt(a)}</td>
              <td className="mono" style={{color:'var(--acc)'}}>{fmt(v)}</td>
              <td className="mono" style={{color:d >= 0 ? 'var(--acc)' : 'var(--bad)'}}>{fmtPct1(d)}</td>
              <td>{done ? <span className="chip ok"><Icon name="check" size={11}/>Завершён</span> : (delays[p.id]||0) > 1 ? <span className="chip warn">С задержками</span> : <span className="chip">В реализации</span>}</td>
            </tr>;
          })}
          <tr><td><b>Резерв</b></td><td className="mono">{fmt(reserve)}</td><td className="mono">{fmt(reserve)}</td><td className="mono">—</td><td><span className="chip">Не размещён</span></td></tr>
        </tbody>
      </table>
      <div className="cc-tag" style={{marginTop:18, marginBottom:10}}>Решения задним числом (демо-оценка)</div>
      <table className="tbl">
        <thead><tr><th>Раунд</th><th>Событие</th><th>Ваш выбор</th><th>Оптимальный выбор</th><th>Δ капитала</th></tr></thead>
        <tbody>
          {logs.map(l => {
            const oi = optimalIdx(l.ao, l.ctx);
            const diff = counterTotal(l.ao[oi], l.ctx) - l.total;
            return <tr key={l.round}>
              <td className="mono">{l.round}</td>
              <td>{l.ev.t}</td>
              <td>{l.ev.o[l.optI].l}{oi === l.optI && <span className="chip ok" style={{marginLeft:8, fontSize:9}}>оптимально</span>}</td>
              <td>{oi === l.optI ? <span className="chip" style={{fontSize:10}}>—</span> : l.ev.o[oi].l}</td>
              <td className="mono" style={{color:diff > 0 ? 'var(--warn)' : 'var(--muted)'}}>{diff > 0 ? fmtSign(Math.round(diff)) : '—'}</td>
            </tr>;
          })}
        </tbody>
      </table>
      <p className="res-note" style={{margin:'10px 0 0'}}>Альтернативы оценены при том же рыночном дрейфе раунда.</p>
      <div className="cc-tag" style={{marginTop:18, marginBottom:10}}>Журнал решений кризисного симулятора</div>
      <table className="tbl">
        <thead><tr><th>Раунд</th><th>Событие</th><th>Решение</th><th>Δ капитала</th><th>Итог</th></tr></thead>
        <tbody>{logs.map(l => <tr key={l.round}>
          <td className="mono">{l.round}</td><td>{l.ev.cat} · {l.ev.t}</td><td>{l.ev.o[l.optI].l}{l.insight ? ' (инсайт)' : ''}</td>
          <td className="mono" style={{color:(l.drift + l.evDelta) >= 0 ? 'var(--acc)' : 'var(--bad)'}}>{fmtSign(l.drift + l.evDelta)}</td>
          <td className="mono">{fmt(l.total)}</td>
        </tr>)}</tbody>
      </table>
      <div className="cc-tag" style={{marginTop:18, marginBottom:10}}>Как собран итоговый рейтинг</div>
      {ratingBreakdown(m).map(b => <div key={b[0]} className="factor">
        <span>{b[0]}</span><div className="fb"><i style={{width:b[1]+'%'}}/></div><em className="mono">{Math.round(b[1])}</em>
      </div>)}
      <p className="res-note">Бонусы: +1,5 за завершённый проект (до +9), +2/уровень «Скоринга», +2/уровень «Депозитария», +3/меморандум, +3/инсайт расследования, до +8 за очки детектива ({detScore}), {(clamp((rep-50)/10, -5, 5) >= 0 ? '+' : '') + clamp((rep-50)/10, -5, 5).toFixed(1)} за репутацию. {stress ? 'Стресс ×1,2 применён. ' : ''}Итог: {Math.round(m.total)} — «{m.tier.name}».</p>
    </Modal>

    {toast && <div className="toast" role="status">{toast}</div>}
    {achToast && <div className="toast ach" role="status"><Icon name="trophy" size={16}/>{achToast}</div>}
  </div>;
}
function CapVal({v}:{v:number}) {
  const ref = useRef<HTMLSpanElement|null>(null);
  const prev = useRef(v);
  useEffect(() => {
    const el = ref.current; if (!el) return;
    const from = prev.current;
    prev.current = v;
    el.textContent = fmt(v);
    if (Math.abs(v - from) <= 0.5) return;
    el.classList.remove('up','down');
    void el.offsetWidth;
    el.classList.add(v > from ? 'up' : 'down');
    const t = window.setTimeout(() => { if (ref.current) ref.current.classList.remove('up','down'); }, 900);
    return () => window.clearTimeout(t);
  }, [v]);
  return <span ref={ref} className="capval-anim">{fmt(v)}</span>;
}

ReactDOM.createRoot(document.getElementById('root')!, {
  onRecoverableError: function(err:any){
    if (window.nexusErrBanner) window.nexusErrBanner(String(err && err.message ? err.message : err));
  }
}).render(<Safe label="Игра" onReset={() => location.reload()}><App/></Safe>);
</script>

<script>
(function () {
  try {
    var src = document.getElementById('ts-src').textContent;
    var out = Babel.transform(src, {
      filename: 'game.tsx',
      presets: [['typescript', { allExtensions: true, isTSX: true }], ['react', {}]]
    }).code;
    (new Function(out))();
  } catch (e) {
    var msg = (e && e.message ? e.message : String(e));
    var d = document.createElement('pre');
    d.style.cssText = 'color:#e06a4e;padding:24px;white-space:pre-wrap;font:13px monospace';
    d.textContent = 'Ошибка инициализации: ' + msg;
    document.getElementById('root').appendChild(d);
    if (window.nexusErrBanner) window.nexusErrBanner(msg);
  }
})();
</script>
</body>
</html>