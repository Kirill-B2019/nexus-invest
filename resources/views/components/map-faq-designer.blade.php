@props([
    'title' => 'Инвестиционные потребности регионов РФ',
    'subtitle' => 'Интерактивная карта с детализацией по регионам. Наведите на регион для подсказки, нажмите для подробностей. Цифры отражают целевые показатели экосистемы к 2031 г.',
    'faqItems' => [],
    'stats' => [
        'projects' => '350 тыс+',
        'clients' => '7 млн+',
        'deals' => '700 тыс',
        'turnover' => '7 млрд+'
    ]
])

{{-- Объединённый блок: Карта (слева) + FAQ (справа) — дизайн-редакция --}}
<section class="section-box wow fadeIn map-faq-designer-block">
    <div class="map-faq-designer-block__label-row">
        <div class="map-faq-designer-block__eyebrow">
            Раздел 06 · Интерактивная аналитика · Цель к 2031
        </div>
        <div class="map-faq-designer-block__tag">
            <span class="map-faq-designer-block__tag-dot"></span>
            Live · Обновлено только что
        </div>
    </div>

    <div class="map-faq-designer-block__frame">
        <div class="map-faq-designer-block__inner">
            <div class="map-faq-designer-block__grid">

                {{-- Левая часть: Карта --}}
                <div class="map-faq-designer-block__map-col" id="rf-map-container">
                    <div class="map-faq-designer-block__map-head">
                        <div class="map-faq-designer-block__map-head-left">
                            <div class="map-faq-designer-block__map-eyebrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                    <path d="M2 17l10 5 10-5"/>
                                    <path d="M2 12l10 5 10-5"/>
                                </svg>
                                Аналитика · Регионы РФ · Цель к 2031 году
                            </div>
                            <h2 class="map-faq-designer-block__map-title">
                                Инвестиционные <span>потребности регионов</span> РФ
                            </h2>
                            <p class="map-faq-designer-block__map-sub">
                                <b>Интерактивная карта</b> с детализацией по регионам. Наведите на регион для подсказки, нажмите для подробностей. Цифры отражают целевые показатели экосистемы к 2031 г.
                            </p>
                            <p class="map-faq-designer-block__map-demo">
                                * Карта носит демонстрационный характер
                            </p>
                        </div>

                        <div class="map-faq-designer-block__stats-row">
                            <div class="map-faq-designer-block__stat-card map-faq-designer-block__stat-card--highlight">
                                <div class="map-faq-designer-block__stat-label">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                    </svg>
                                    Проектов
                                </div>
                                <div class="map-faq-designer-block__stat-value">{{ $stats['projects'] }}</div>
                                <div class="map-faq-designer-block__stat-foot">Завершённых и <b>активных</b></div>
                            </div>
                            <div class="map-faq-designer-block__stat-card">
                                <div class="map-faq-designer-block__stat-label">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    Клиентов
                                </div>
                                <div class="map-faq-designer-block__stat-value">{{ $stats['clients'] }}</div>
                                <div class="map-faq-designer-block__stat-foot">Зарегистрировано в экосистеме</div>
                            </div>
                            <div class="map-faq-designer-block__stat-card">
                                <div class="map-faq-designer-block__stat-label">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                                    </svg>
                                    Сделок
                                </div>
                                <div class="map-faq-designer-block__stat-value">{{ $stats['deals'] }}</div>
                                <div class="map-faq-designer-block__stat-foot">В год по всем видам</div>
                            </div>
                            <div class="map-faq-designer-block__stat-card map-faq-designer-block__stat-card--highlight">
                                <div class="map-faq-designer-block__stat-label">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="1" x2="12" y2="23"/>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                    </svg>
                                    Оборот, ₽
                                </div>
                                <div class="map-faq-designer-block__stat-value">{{ $stats['turnover'] }}</div>
                                <div class="map-faq-designer-block__stat-foot">В год по всем видам <b>сделок</b></div>
                            </div>
                        </div>
                    </div>

                    <div class="map-faq-designer-block__filters-wrap">
                        <div class="map-faq-designer-block__fld">
                            <label class="map-faq-designer-block__fld-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                    <polyline points="9 22 9 12 15 12 15 22"/>
                                </svg>
                                Отрасль
                            </label>
                            <div class="map-faq-designer-block__pill-select">
                                <select><option>Все</option></select>
                            </div>
                        </div>
                        <div class="map-faq-designer-block__fld">
                            <label class="map-faq-designer-block__fld-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                Регион
                            </label>
                            <div class="map-faq-designer-block__pill-select">
                                <select><option>Все</option></select>
                            </div>
                        </div>
                        <div class="map-faq-designer-block__fld">
                            <label class="map-faq-designer-block__fld-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                                    <polyline points="17 6 23 6 23 12"/>
                                </svg>
                                Стадия
                            </label>
                            <div class="map-faq-designer-block__pill-select">
                                <select><option>Все</option></select>
                            </div>
                        </div>
                        <div class="map-faq-designer-block__fld">
                            <label class="map-faq-designer-block__fld-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="1" x2="12" y2="23"/>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                </svg>
                                Объём в рублях РФ
                            </label>
                            <div class="map-faq-designer-block__pill-select">
                                <select><option>Все</option></select>
                            </div>
                        </div>
                    </div>

                    <div class="map-faq-designer-block__map-area">
                        <div class="map-faq-designer-block__map-floating-card">
                            <div class="map-faq-designer-block__mfc-title">Топ-3 региона</div>
                            <div class="map-faq-designer-block__mfc-item"><span class="map-faq-designer-block__mfc-k">Москва</span><span class="map-faq-designer-block__mfc-v">34</span></div>
                            <div class="map-faq-designer-block__mfc-item"><span class="map-faq-designer-block__mfc-k">Санкт‑Петербург</span><span class="map-faq-designer-block__mfc-v">21</span></div>
                            <div class="map-faq-designer-block__mfc-item"><span class="map-faq-designer-block__mfc-k">Татарстан</span><span class="map-faq-designer-block__mfc-v">14</span></div>
                        </div>

                        <div class="map-faq-designer-block__russia-svg-wrap" id="rf-map-svg-container">
                            <!-- Реальная карта будет загружена через JS -->
                        </div>
                    </div>

                    <div class="map-faq-designer-block__map-legend">
                        <div class="map-faq-designer-block__legend-items">
                            <div class="map-faq-designer-block__legend-item">
                                <span class="map-faq-designer-block__legend-dot map-faq-designer-block__legend-dot--active"></span>
                                Активные <span class="map-faq-designer-block__legend-count">127</span>
                            </div>
                            <div class="map-faq-designer-block__legend-item">
                                <span class="map-faq-designer-block__legend-dot map-faq-designer-block__legend-dot--planned"></span>
                                Планируемые <span class="map-faq-designer-block__legend-count">43</span>
                            </div>
                            <div class="map-faq-designer-block__legend-item">
                                <span class="map-faq-designer-block__legend-dot map-faq-designer-block__legend-dot--pending"></span>
                                На проверке <span class="map-faq-designer-block__legend-count">18</span>
                            </div>
                        </div>
                        <div class="map-faq-designer-block__legend-bar">
                            <div class="map-faq-designer-block__legend-bar-track">
                                <div class="map-faq-designer-block__legend-bar-seg map-faq-designer-block__legend-bar-seg--s1" style="width:68%"></div>
                                <div class="map-faq-designer-block__legend-bar-seg map-faq-designer-block__legend-bar-seg--s2" style="width:23%"></div>
                                <div class="map-faq-designer-block__legend-bar-seg map-faq-designer-block__legend-bar-seg--s3" style="width:9%"></div>
                            </div>
                            <div class="map-faq-designer-block__legend-bar-label">188 всего · 68 / 23 / 9 %</div>
                        </div>
                        <a href="#" class="map-faq-designer-block__legend-cta">
                            Открыть карту
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Правая часть: FAQ --}}
                <div class="map-faq-designer-block__faq-col">
                    <div class="map-faq-designer-block__faq-head">
                        <div class="map-faq-designer-block__faq-eyebrow">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                                <line x1="12" y1="17" x2="12.01" y2="17"/>
                            </svg>
                            FAQ · Платформа НЕКСУС
                        </div>
                        <h2 class="map-faq-designer-block__faq-title">Остались<br>вопросы?</h2>
                        <p class="map-faq-designer-block__faq-sub">
                            Ниже — ответы на частые вопросы. Дополнительные материалы — в разделе <a href="#"><b>«Документация»</b></a>.
                        </p>
                    </div>

                    <div class="map-faq-designer-block__faq-counter-row">
                        <div class="map-faq-designer-block__faq-counter">
                            <span class="map-faq-designer-block__faq-counter-num">{{ count($faqItems) }}</span>
                            <span>вопросов в разделе</span>
                        </div>
                        <div class="map-faq-designer-block__faq-counter-sep"></div>
                        <a href="#" class="map-faq-designer-block__faq-counter-link">
                            Все вопросы
                            <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    </div>

                    <div class="map-faq-designer-block__faq-content">
                        <x-guest.faq-accordion :items="$faqItems" accordionId="mapFaqDesignerAccordion" />
                    </div>

                    <div class="map-faq-designer-block__faq-foot">
                        <div class="map-faq-designer-block__faq-foot-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10 9 9 9 8 9"/>
                            </svg>
                        </div>
                        <div>
                            <div class="map-faq-designer-block__faq-foot-title">Раздел документации</div>
                            <div class="map-faq-designer-block__faq-foot-sub">PDF: оферта · соглашение · KYC/AML · <b>White Paper</b> и др.</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
:root {
    --map-faq-bg-0: #0a0a0a;
    --map-faq-bg-1: #111215;
    --map-faq-bg-2: #15171b;
    --map-faq-bg-3: #1a1d22;
    --map-faq-line-1: rgba(255, 255, 255, 0.06);
    --map-faq-line-2: rgba(255, 255, 255, 0.10);
    --map-faq-line-3: rgba(255, 255, 255, 0.16);
    --map-faq-text-1: #ffffff;
    --map-faq-text-2: rgba(255, 255, 255, 0.72);
    --map-faq-text-3: rgba(255, 255, 255, 0.48);
    --map-faq-text-4: rgba(255, 255, 255, 0.30);
    --map-faq-accent: #C5FF41;
    --map-faq-accent-2: #9CE10A;
    --map-faq-accent-rgb: 197, 255, 65;
    --map-faq-accent-soft: rgba(197, 255, 65, 0.14);
    --map-faq-accent-line: rgba(197, 255, 65, 0.55);
    --map-faq-rad-pad: 22px;
    --map-faq-rad-md: 16px;
    --map-faq-rad-sm: 12px;
}

.map-faq-designer-block {
    padding: 48px 40px;
    background: var(--map-faq-bg-0);
}

.map-faq-designer-block__label-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.map-faq-designer-block__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--map-faq-accent);
}

.map-faq-designer-block__eyebrow::before {
    content: "";
    display: inline-block;
    width: 28px;
    height: 1px;
    background: linear-gradient(90deg, var(--map-faq-accent), transparent);
}

.map-faq-designer-block__tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    font-size: 11px;
    font-weight: 600;
    color: var(--map-faq-text-2);
    background: var(--map-faq-bg-2);
    border: 1px solid var(--map-faq-line-2);
    border-radius: 999px;
}

.map-faq-designer-block__tag-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--map-faq-accent);
    box-shadow: 0 0 8px var(--map-faq-accent);
}

.map-faq-designer-block__frame {
    position: relative;
    border-radius: calc(var(--map-faq-rad-pad) + 4px);
    padding: 1px;
    background:
        linear-gradient(135deg, rgba(var(--map-faq-accent-rgb), 0.38) 0%, transparent 25%, transparent 75%, rgba(var(--map-faq-accent-rgb), 0.22) 100%),
        linear-gradient(var(--map-faq-line-2), var(--map-faq-line-2));
    box-shadow: 0 30px 80px -30px rgba(0,0,0,0.85), 0 0 0 1px rgba(0,0,0,0.4);
}

.map-faq-designer-block__frame::before {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background:
        radial-gradient(800px 380px at 10% -10%, rgba(var(--map-faq-accent-rgb), 0.10), transparent 60%),
        radial-gradient(600px 360px at 110% 110%, rgba(var(--map-faq-accent-rgb), 0.07), transparent 55%);
    pointer-events: none;
}

.map-faq-designer-block__inner {
    position: relative;
    border-radius: var(--map-faq-rad-pad);
    background: linear-gradient(180deg, #14161a 0%, #101216 100%);
    overflow: hidden;
}

.map-faq-designer-block__grid {
    display: grid;
    grid-template-columns: 1fr 460px;
    min-height: 760px;
}

/* MAP COLUMN */
.map-faq-designer-block__map-col {
    position: relative;
    padding: 40px 40px 36px;
    display: flex;
    flex-direction: column;
}

.map-faq-designer-block__map-col::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 1px 1px, rgba(255,255,255,0.045) 1px, transparent 0);
    background-size: 22px 22px;
    mask-image: radial-gradient(closest-side at 60% 50%, #000 40%, transparent 92%);
    pointer-events: none;
}

.map-faq-designer-block__map-head {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 22px;
}

.map-faq-designer-block__map-head-left {
    max-width: 600px;
}

.map-faq-designer-block__map-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.24em;
    text-transform: uppercase;
    color: var(--map-faq-text-3);
    margin-bottom: 12px;
}

.map-faq-designer-block__map-eyebrow svg {
    width: 14px; height: 14px;
    color: var(--map-faq-accent);
}

.map-faq-designer-block__map-title {
    font-size: 28px;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.015em;
    margin-bottom: 8px;
    color: var(--map-faq-text-1);
}

.map-faq-designer-block__map-title span {
    color: var(--map-faq-accent);
}

.map-faq-designer-block__map-sub {
    font-size: 13.5px;
    line-height: 1.5;
    color: var(--map-faq-text-3);
    max-width: 560px;
}

.map-faq-designer-block__map-sub b {
    color: var(--map-faq-text-2);
    font-weight: 600;
}

.map-faq-designer-block__map-demo {
    font-size: 11px;
    color: var(--map-faq-text-4);
    margin-top: 4px;
}

.map-faq-designer-block__stats-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    grid-template-rows: repeat(2, minmax(0, 1fr));
    gap: 10px;
    flex-shrink: 0;
    width: 300px;
}

.map-faq-designer-block__stat-card {
    position: relative;
    padding: 12px 14px;
    border-radius: var(--map-faq-rad-md);
    background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.015));
    border: 1px solid var(--map-faq-line-2);
    overflow: hidden;
}

.map-faq-designer-block__stat-card::after {
    content: "";
    position: absolute;
    top: -40%; right: -30%;
    width: 100px; height: 100px;
    background: radial-gradient(circle, rgba(var(--map-faq-accent-rgb), 0.22), transparent 65%);
    filter: blur(2px);
    pointer-events: none;
}

.map-faq-designer-block__stat-card--highlight {
    border-color: rgba(var(--map-faq-accent-rgb), 0.3);
    background:
        linear-gradient(180deg, rgba(var(--map-faq-accent-rgb), 0.10), rgba(var(--map-faq-accent-rgb), 0.02)),
        linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
}

.map-faq-designer-block__stat-label {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--map-faq-text-4);
    margin-bottom: 5px;
}

.map-faq-designer-block__stat-label svg {
    width: 11px; height: 11px;
}

.map-faq-designer-block__stat-card--highlight .map-faq-designer-block__stat-label {
    color: var(--map-faq-accent);
}

.map-faq-designer-block__stat-value {
    font-size: 19px;
    font-weight: 800;
    letter-spacing: -0.02em;
    line-height: 1;
    font-variant-numeric: tabular-nums;
    color: var(--map-faq-text-1);
}

.map-faq-designer-block__stat-card--highlight .map-faq-designer-block__stat-value {
    background: linear-gradient(180deg, #fff, var(--map-faq-accent));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.map-faq-designer-block__stat-foot {
    margin-top: 4px;
    font-size: 10.5px;
    color: var(--map-faq-text-4);
}

.map-faq-designer-block__stat-foot b {
    color: var(--map-faq-text-2);
}

/* Filters */
.map-faq-designer-block__filters-wrap {
    position: relative;
    z-index: 1;
    padding: 13px;
    border-radius: var(--map-faq-rad-md);
    background: rgba(255,255,255,0.025);
    border: 1px solid var(--map-faq-line-2);
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px;
    margin-bottom: 16px;
}

.map-faq-designer-block__fld {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.map-faq-designer-block__fld-label {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--map-faq-text-4);
}

.map-faq-designer-block__fld-label svg {
    width: 11px; height: 11px;
    color: var(--map-faq-accent);
    opacity: 0.85;
}

.map-faq-designer-block__pill-select {
    position: relative;
}

.map-faq-designer-block__pill-select select {
    width: 100%;
    appearance: none;
    -webkit-appearance: none;
    padding: 9px 32px 9px 34px;
    border-radius: var(--map-faq-rad-sm);
    background: var(--map-faq-bg-3);
    border: 1px solid var(--map-faq-line-2);
    color: var(--map-faq-text-1);
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s;
}

.map-faq-designer-block__pill-select select:hover {
    border-color: var(--map-faq-line-3);
}

.map-faq-designer-block__pill-select select:focus {
    outline: none;
    border-color: var(--map-faq-accent);
    box-shadow: 0 0 0 3px rgba(var(--map-faq-accent-rgb), 0.18);
}

.map-faq-designer-block__pill-select::before {
    content: "";
    position: absolute;
    left: 11px; top: 50%;
    transform: translateY(-50%);
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--map-faq-accent);
    box-shadow: 0 0 0 3px rgba(var(--map-faq-accent-rgb), 0.18);
}

.map-faq-designer-block__pill-select::after {
    content: "";
    position: absolute;
    right: 11px; top: 50%;
    transform: translateY(-50%);
    width: 9px; height: 9px;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff60'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-size: contain;
    pointer-events: none;
}

/* Map area */
.map-faq-designer-block__map-area {
    position: relative;
    z-index: 1;
    flex: 1;
    min-height: 370px;
    border-radius: var(--map-faq-rad-md);
    background:
        radial-gradient(600px 280px at 50% 30%, rgba(var(--map-faq-accent-rgb), 0.05), transparent 65%),
        linear-gradient(180deg, #14171c 0%, #101217 100%);
    border: 1px solid var(--map-faq-line-2);
    overflow: hidden;
    padding: 18px 22px 16px;
    display: flex;
    flex-direction: column;
}

.map-faq-designer-block__map-floating-card {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 210px;
    padding: 12px 14px;
    border-radius: var(--map-faq-rad-sm);
    background: rgba(20, 22, 26, 0.86);
    backdrop-filter: blur(8px);
    border: 1px solid var(--map-faq-line-2);
    box-shadow: 0 1px 2px rgba(0,0,0,0.4), 0 8px 24px -8px rgba(0,0,0,0.6);
}

.map-faq-designer-block__mfc-title {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--map-faq-accent);
    margin-bottom: 8px;
}

.map-faq-designer-block__mfc-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 5px 0;
    border-bottom: 1px dashed var(--map-faq-line-1);
    font-size: 11.5px;
}

.map-faq-designer-block__mfc-item:last-child {
    border-bottom: none;
}

.map-faq-designer-block__mfc-k {
    color: var(--map-faq-text-3);
}

.map-faq-designer-block__mfc-v {
    font-weight: 700;
    color: var(--map-faq-text-1);
    font-variant-numeric: tabular-nums;
}

.map-faq-designer-block__russia-svg-wrap {
    position: relative;
    flex: 1;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 320px;
}

.map-faq-designer-block__map-legend {
    position: relative;
    z-index: 1;
    margin-top: 12px;
    padding: 12px 16px;
    border-radius: var(--map-faq-rad-md);
    background: rgba(255,255,255,0.02);
    border: 1px solid var(--map-faq-line-2);
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    gap: 20px;
}

.map-faq-designer-block__legend-items {
    display: flex;
    align-items: center;
    gap: 22px;
}

.map-faq-designer-block__legend-item {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    font-size: 12px;
    color: var(--map-faq-text-2);
}

.map-faq-designer-block__legend-dot {
    width: 11px; height: 11px;
    border-radius: 50%;
    flex-shrink: 0;
}

.map-faq-designer-block__legend-dot--active {
    background: var(--map-faq-accent);
    box-shadow: 0 0 10px rgba(var(--map-faq-accent-rgb), 0.8);
}

.map-faq-designer-block__legend-dot--planned {
    background: transparent;
    border: 1.5px solid var(--map-faq-text-3);
}

.map-faq-designer-block__legend-dot--pending {
    background: var(--map-faq-text-4);
}

.map-faq-designer-block__legend-count {
    margin-left: 2px;
    font-weight: 700;
    color: var(--map-faq-text-1);
    font-variant-numeric: tabular-nums;
}

.map-faq-designer-block__legend-bar {
    display: flex;
    align-items: center;
    gap: 10px;
}

.map-faq-designer-block__legend-bar-track {
    flex: 1;
    height: 7px;
    border-radius: 999px;
    background: var(--map-faq-bg-3);
    overflow: hidden;
    display: flex;
}

.map-faq-designer-block__legend-bar-seg {
    height: 100%;
}

.map-faq-designer-block__legend-bar-seg--s1 {
    background: var(--map-faq-accent);
}

.map-faq-designer-block__legend-bar-seg--s2 {
    background: var(--map-faq-text-3);
}

.map-faq-designer-block__legend-bar-seg--s3 {
    background: var(--map-faq-text-4);
}

.map-faq-designer-block__legend-bar-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--map-faq-text-2);
    white-space: nowrap;
    font-variant-numeric: tabular-nums;
}

.map-faq-designer-block__legend-cta {
    justify-self: end;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 13px;
    font-size: 11.5px;
    font-weight: 700;
    color: #0b1300;
    background: var(--map-faq-accent);
    border-radius: var(--map-faq-rad-sm);
    text-decoration: none;
    transition: all .2s;
    box-shadow: 0 4px 14px -6px rgba(var(--map-faq-accent-rgb), 0.6);
}

.map-faq-designer-block__legend-cta:hover {
    background: #D6FF66;
    transform: translateY(-1px);
}

.map-faq-designer-block__legend-cta svg {
    width: 13px; height: 13px;
}

/* FAQ COLUMN */
.map-faq-designer-block__faq-col {
    position: relative;
    padding: 40px 36px 40px 40px;
    border-left: 1px solid var(--map-faq-line-1);
    background: linear-gradient(180deg, rgba(255,255,255,0.015), rgba(255,255,255,0));
}

.map-faq-designer-block__faq-col::before {
    content: "";
    position: absolute;
    top: 0; right: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, var(--map-faq-accent) 0%, rgba(var(--map-faq-accent-rgb), 0.15) 100%);
    border-radius: 2px 0 0 2px;
}

.map-faq-designer-block__faq-col::after {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(var(--map-faq-line-1) 1px, transparent 1px),
        linear-gradient(90deg, var(--map-faq-line-1) 1px, transparent 1px);
    background-size: 32px 32px;
    mask-image: linear-gradient(180deg, rgba(0,0,0,0.22), transparent 72%);
    pointer-events: none;
    opacity: 0.6;
}

.map-faq-designer-block__faq-head {
    position: relative;
    z-index: 1;
    margin-bottom: 24px;
}

.map-faq-designer-block__faq-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 12px;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.24em;
    text-transform: uppercase;
    color: var(--map-faq-accent);
    background: var(--map-faq-accent-soft);
    border: 1px solid var(--map-faq-accent-line);
    border-radius: 999px;
    margin-bottom: 16px;
}

.map-faq-designer-block__faq-eyebrow svg {
    width: 13px; height: 13px;
}

.map-faq-designer-block__faq-title {
    font-size: 30px;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.015em;
    margin-bottom: 10px;
    background: linear-gradient(180deg, #fff 0%, rgba(255,255,255,0.82) 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.map-faq-designer-block__faq-sub {
    font-size: 13px;
    line-height: 1.55;
    color: var(--map-faq-text-3);
}

.map-faq-designer-block__faq-sub b {
    color: var(--map-faq-text-1);
    font-weight: 600;
}

.map-faq-designer-block__faq-sub a {
    color: var(--map-faq-accent);
    text-decoration: none;
    font-weight: 700;
}

.map-faq-designer-block__faq-counter-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 14px;
    margin: 18px 0 16px;
    border-radius: var(--map-faq-rad-sm);
    background: rgba(255,255,255,0.025);
    border: 1px solid var(--map-faq-line-2);
}

.map-faq-designer-block__faq-counter {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
    color: var(--map-faq-text-3);
}

.map-faq-designer-block__faq-counter-num {
    font-size: 18px;
    font-weight: 800;
    color: var(--map-faq-accent);
    font-variant-numeric: tabular-nums;
}

.map-faq-designer-block__faq-counter-sep {
    width: 1px; height: 18px;
    background: var(--map-faq-line-2);
}

.map-faq-designer-block__faq-counter-link {
    color: var(--map-faq-accent);
    text-decoration: none;
    font-size: 11.5px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.map-faq-designer-block__faq-content {
    position: relative;
    z-index: 1;
    margin-bottom: 22px;
}

/* Стилизация стандартного аккордеона под дизайн */
.map-faq-designer-block .accordion-style-2 .accordion-item {
    border: none;
    background: transparent;
    margin-bottom: 8px;
}

.map-faq-designer-block .accordion-style-2 .accordion-button {
    background: rgba(255,255,255,0.022);
    color: var(--map-faq-text-1);
    border: 1px solid var(--map-faq-line-2);
    border-radius: var(--map-faq-rad-md);
    padding: 13px 15px;
    font-size: 13.5px;
    font-weight: 600;
    line-height: 1.35;
    transition: all .22s;
}

.map-faq-designer-block .accordion-style-2 .accordion-button:not(.collapsed) {
    background: rgba(var(--map-faq-accent-rgb), 0.05);
    color: var(--map-faq-text-1);
    border-color: rgba(var(--map-faq-accent-rgb), 0.35);
    box-shadow: none;
}

.map-faq-designer-block .accordion-style-2 .accordion-button::after {
    width: 26px;
    height: 26px;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23ffffff48' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'/%3e%3c/svg%3e");
    background-size: 13px 13px;
    transition: transform .22s;
}

.map-faq-designer-block .accordion-style-2 .accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230b1300' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'/%3e%3c/svg%3e");
    transform: rotate(180deg);
}

.map-faq-designer-block .accordion-style-2 .accordion-button:not(.collapsed) {
    background: rgba(var(--map-faq-accent-rgb), 0.05);
}

.map-faq-designer-block .accordion-style-2 .accordion-body {
    background: rgba(255,255,255,0.03);
    color: var(--map-faq-text-2);
    border: 1px solid var(--map-faq-line-2);
    border-top: none;
    border-radius: 0 0 var(--map-faq-rad-md) var(--map-faq-rad-md);
    margin-top: -8px;
    margin-bottom: 8px;
    padding: 16px;
    font-size: 12.5px;
    line-height: 1.6;
}

.map-faq-designer-block .accordion-style-2 .accordion-body p {
    margin-bottom: 8px;
}

.map-faq-designer-block .accordion-style-2 .accordion-body p:last-child {
    margin-bottom: 0;
}

.map-faq-designer-block__faq-foot {
    position: relative;
    z-index: 1;
    padding: 14px 16px;
    border-radius: var(--map-faq-rad-md);
    background: linear-gradient(135deg, rgba(var(--map-faq-accent-rgb), 0.10), rgba(var(--map-faq-accent-rgb), 0.02));
    border: 1px solid rgba(var(--map-faq-accent-rgb), 0.22);
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 12px;
    align-items: center;
}

.map-faq-designer-block__faq-foot-icon {
    width: 40px; height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: var(--map-faq-accent);
    color: #0b1300;
    flex-shrink: 0;
}

.map-faq-designer-block__faq-foot-icon svg {
    width: 20px; height: 20px;
}

.map-faq-designer-block__faq-foot-title {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 2px;
}

.map-faq-designer-block__faq-foot-sub {
    font-size: 11.5px;
    color: var(--map-faq-text-3);
    line-height: 1.45;
}

.map-faq-designer-block__faq-foot-sub b {
    color: var(--map-faq-text-2);
    font-weight: 600;
}

@media (max-width: 991.98px) {
    .map-faq-designer-block {
        padding: 32px 20px;
    }

    .map-faq-designer-block__grid {
        grid-template-columns: 1fr;
        min-height: auto;
        gap: 32px;
    }

    .map-faq-designer-block__map-col {
        padding: 24px;
    }

    .map-faq-designer-block__faq-col {
        padding: 24px;
    }

    .map-faq-designer-block__stats-row {
        width: 100%;
    }

    .map-faq-designer-block__filters-wrap {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .map-faq-designer-block__map-legend {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .map-faq-designer-block__legend-cta {
        justify-self: start;
    }
}
</style>
@endpush

@push('scripts')
<script>
(function() {
    // Загрузка реальной карты из russia-regions.svg
    const mapContainer = document.getElementById('rf-map-svg-container');
    if (mapContainer) {
        fetch('{{ asset("assets/svg/russia-regions.svg") }}')
            .then(response => response.text())
            .then(svgContent => {
                // Создаем wrapper SVG с нужными стилями
                const wrapperSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                wrapperSvg.setAttribute('class', 'rf-svg');
                wrapperSvg.setAttribute('viewBox', '0 0 1000 600');
                wrapperSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                wrapperSvg.style.width = '100%';
                wrapperSvg.style.maxWidth = '760px';
                wrapperSvg.style.height = 'auto';
                wrapperSvg.style.maxHeight = '320px';
                wrapperSvg.style.filter = 'drop-shadow(0 20px 40px rgba(0,0,0,0.5))';

                // Парсим загруженный SVG и извлекаем path элементы
                const parser = new DOMParser();
                const svgDoc = parser.parseFromString(svgContent, 'image/svg+xml');
                const paths = svgDoc.querySelectorAll('path');

                // Добавляем пути в wrapper
                paths.forEach(path => {
                    const clonedPath = path.cloneNode(true);
                    // Применяем стили для карты
                    clonedPath.style.fill = 'rgba(80, 85, 95, 0.9)';
                    clonedPath.style.stroke = 'rgba(197, 255, 65, 0.45)';
                    clonedPath.style.strokeWidth = '0.5';
                    clonedPath.style.transition = 'fill 0.2s, stroke 0.2s';
                    wrapperSvg.appendChild(clonedPath);
                });

                mapContainer.innerHTML = '';
                mapContainer.appendChild(wrapperSvg);
            })
            .catch(error => {
                console.error('Ошибка загрузки карты:', error);
                mapContainer.innerHTML = '<div style="color: rgba(255,255,255,0.48); font-size: 13px;">Карта не загрузилась</div>';
            });
    }
})();
</script>
@endpush
