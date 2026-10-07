{{-- Секция объединяет карточки руководителей проекта и описания функциональных команд. --}}
<section class="section-box wow box-why-trusted-black team-section" id="team">
    <div class="container">
        <div class="team-block">
            <div class="team-block__head">
                <a class="btn btn-brand-4-sm" href="#onwer">{{ __('Руководители команды и проекта') }}</a>
                <h2 class="team-block__title">{{ __('Команда, которая строит новый стандарт проектного запуска и цифровых инвестиций') }}</h2>
            </div>

            <div class="team-leaders" id="onwer">
                <article class="team-leader">
                    <div class="team-leader__photo">
                        <img src="{{ asset('assets/imgs/page/homepage1/img-review.png') }}" alt="{{ __('ЮРИЙ ХЕ') }}" loading="lazy" decoding="async" width="420" height="420">
                    </div>
                    <h3 class="team-leader__name">{{ __('ЮРИЙ ХЕ') }}</h3>
                    <p class="team-leader__role">{{ __('Генеральный директор - соучредитель') }}</p>
                    <p class="team-leader__quote">{{ __('Мы создаём не просто бизнес‑платформу для инвестиций, а новую инфраструктуру рынка, где цифровые инструменты становятся понятным, прозрачным и эффективно работающим каналом капитала в реальную экономику.') }}</p>
                    <div class="team-leader__stars" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt="">
                    </div>
                </article>

                <article class="team-leader">
                    <div class="team-leader__photo">
                        <img src="{{ asset('assets/imgs/page/homepage1/img-review-finance.png') }}" alt="{{ __('АДЫЛ НУРМАНБЕТОВ') }}" loading="lazy" decoding="async" width="420" height="420">
                    </div>
                    <h3 class="team-leader__name">{{ __('АДЫЛ НУРМАНБЕТОВ') }}</h3>
                    <p class="team-leader__role">{{ __('Финансовый директор - соучредитель') }}</p>
                    <p class="team-leader__quote">{{ __('Финансовая архитектура платформы выстроена так, чтобы обеспечивать прозрачную структуру капитала, контролируемую доходность инструментов и устойчивость модели роста на каждом этапе проектного цикла.') }}</p>
                    <div class="team-leader__stars" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt="">
                    </div>
                </article>

                <article class="team-leader">
                    <div class="team-leader__photo">
                        <img src="{{ asset('assets/imgs/page/homepage1/img-review-k.png') }}" alt="{{ __('КИРИЛЛ БОЯРИНОВ') }}" loading="lazy" decoding="async" width="420" height="420">
                    </div>
                    <h3 class="team-leader__name">{{ __('КИРИЛЛ БОЯРИНОВ') }}</h3>
                    <p class="team-leader__role">{{ __('Автор платформы, системный архитектор - соучредитель') }}</p>
                    <p class="team-leader__quote">{{ __('Я проектирую платформу как целостный механизм, в котором архитектура, код и каждый технический узел связаны в одну логику — превратить сложную финансовую “машину” в управляемую, безопасную и предсказуемую среду роста для проектов и инвесторов.') }}</p>
                    <div class="team-leader__stars" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt=""><img src="{{ asset('assets/imgs/page/homepage1/star.svg') }}" alt="">
                    </div>
                </article>
            </div>

            <div class="team-contours" id="team-contours">
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-1.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">{{ __('Инженерный контур') }}</h3>
                    <p class="team-contours__text">{{ __('Backend, frontend, mobile, DevOps и QA — собирают клиентский слой цифрового банка, личные кабинеты, API‑шлюз к ОИС НЕКСУС и технологический слой ГАНИМЕД в единую управляемую среду.') }}</p>
                </article>
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-2.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">{{ __('Методологи проектного цикла') }}</h3>
                    <p class="team-contours__text">{{ __('Описывают, как проект проходит путь от заявки инициатора до выпуска ЦФА, размещения, контроля траншей и выплат: структуры финансирования, KPI, ковенанты и регламенты, которые затем становятся правилами ОИС и сценариями в экосистеме.') }}</p>
                </article>
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-3.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">{{ __('Аналитики и риск‑менеджеры') }}</h3>
                    <p class="team-contours__text">{{ __('Следят за концентрацией портфелей, отклонениями plan/fact, просрочками и событиями по выпускам; формируют сигналы для инвесторов в кабинете и для операционного контура ОИС — до того, как риск превращается в регуляторный или репутационный инцидент.') }}</p>
                </article>
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-4.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">{{ __('Специалисты комплаенс и правового блока') }}</h3>
                    <p class="team-contours__text">{{ __('Выстраивают допуск участников и проектов под 282‑ФЗ, 115‑ФЗ и требования Банка России к ОИС: KYC/KYB, раскрытие, договорная модель выпуска, взаимодействие с депозитарным и расчётным контуром — отдельно от маркетингового бренда цифрового банка.') }}</p>
                </article>
                <article class="team-contours__tile">
                    <div class="team-contours__media" aria-hidden="true">
                        <img src="{{ asset('assets/imgs/page/homepage1/team-contour-5.png') }}" alt="" loading="lazy" decoding="async" width="640" height="480">
                    </div>
                    <span class="team-contours__check" aria-hidden="true"></span>
                    <h3 class="team-contours__title">
                        <a href="{{ route('nexus-ai') }}">{{ __('Операторы скоринга, ML и оптимизации (НЕКСУС ИИ)') }}</a>
                    </h3>
                    <p class="team-contours__text">{{ __('Обучают и разрабатывают модели предварительного скоринга проектов, подбора инструментов для инвестора и раннего выявления аномалий, контроль параметров допуска и мониторинг обязательств без подмены юридического решения алгоритмом.') }}</p>
                </article>
            </div>
        </div>
    </div>
</section>
