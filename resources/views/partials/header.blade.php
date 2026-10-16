<!-- Top Announcement / Offer Bar -->
<div class="bg-gradient-to-r from-rose-50 via-pink-50 to-rose-50 text-center text-xs md:text-sm py-1.5 md:py-2 font-medium text-rose-800 border-b border-rose-100/70 tracking-wide">
    Get 20% off on your first order! Use code <span class="font-bold text-rose-600 tracking-wider bg-rose-100/70 px-2 py-0.5 rounded text-[11px] md:text-xs ml-1">WELCOME20</span>
</div>

<!-- Sticky header: scrolling down collapses the search row first, then the menu row. The gold ribbon always stays. -->
<style>
    #mainNavbar.is-fixed { position: fixed; left: 0; right: 0; top: 0; }
    #mainNavbar.no-anim .hrow { transition: none; }
    .hrow { display: grid; grid-template-rows: 1fr; transition: grid-template-rows .22s ease-out, opacity .18s ease-out; }
    .hrow.is-collapsed { grid-template-rows: 0fr; opacity: 0; pointer-events: none; }
    .hrow.is-collapsed > .hrow-inner, .hrow.is-animating > .hrow-inner { overflow: hidden; }
    .hrow-inner { min-height: 0; }
    @media (prefers-reduced-motion: reduce) { .hrow { transition: none; } }
</style>

<div id="headerWrap">
<header id="mainNavbar"
        class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur-md shadow-sm border-b border-gray-100 transition-shadow duration-300">
    <div id="rowNav" class="hrow"><div class="hrow-inner"><x-home.nav /></div></div>
    <div id="rowMenu" class="hrow"><div class="hrow-inner"><x-home.category /></div></div>
    <x-home.gold-rate-bar />
</header>
</div>

<script>
    (function () {
        function initSmartNavbar() {
            const header = document.getElementById('mainNavbar');
            const rowNav = document.getElementById('rowNav');
            const rowMenu = document.getElementById('rowMenu');
            if (!header || !rowNav || !rowMenu) return;

            const wrap = document.getElementById('headerWrap');
            const announce = document.querySelector('body > div:first-of-type');
            let locked = false;

            // While collapsing, the header floats (fixed) and its old space is kept, so the
            // page never shifts under the scroll position (that shift caused the jitter).
            function lock() {
                if (locked) return;
                wrap.style.height = header.offsetHeight + 'px';
                header.classList.add('is-fixed');
                locked = true;
            }
            function unlock() {
                if (!locked) return;
                header.classList.add('no-anim');
                rowNav.classList.remove('is-collapsed'); rowMenu.classList.remove('is-collapsed');
                header.classList.remove('is-fixed');
                wrap.style.height = '';
                locked = false;
                requestAnimationFrame(() => requestAnimationFrame(() => header.classList.remove('no-anim')));
            }

            let lastY = Math.max(0, window.pageYOffset || 0);
            let acc = 0;       // scroll distance in the current direction
            let dir = 0;
            let ticking = false;

            const FIRST_STEP = 6;    // px of scrolling before the search row moves
            const SECOND_STEP = 40;  // extra px before the menu row moves
            const PIN_OFFSET = 60;

            function setRow(row, collapsed) {
                if (row.classList.contains('is-collapsed') === collapsed) return;
                row.classList.toggle('is-collapsed', collapsed);
                row.classList.add('is-animating');
                clearTimeout(row._t);
                row._t = setTimeout(() => row.classList.remove('is-animating'), 320);
            }

            function handleScroll() {
                ticking = false;
                const y = Math.max(0, window.pageYOffset || 0);
                const delta = y - lastY;
                lastY = y;

                const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
                if (y >= maxScroll - 20 || delta === 0) return; // ignore bottom bounce

                const d = delta > 0 ? 1 : -1;
                if (d !== dir) { dir = d; acc = 0; }
                acc += Math.abs(delta);

                const topLimit = announce ? announce.offsetHeight : 36;
                if (y <= topLimit) {
                    unlock();
                    header.classList.replace('shadow-md', 'shadow-sm');
                    return;
                }

                const mobileOpen = !!header.querySelector('[x-show="mobileMenu"]:not([style*="display: none"])');

                if (d > 0 && y > PIN_OFFSET && !mobileOpen) {
                    const navHidden = rowNav.classList.contains('is-collapsed');
                    if (!navHidden && acc > FIRST_STEP) { lock(); setRow(rowNav, true); acc = 0; }
                    else if (navHidden && acc > SECOND_STEP) { setRow(rowMenu, true); }
                } else if (d < 0) {
                    header.classList.replace('shadow-sm', 'shadow-md');
                    const navHidden = rowNav.classList.contains('is-collapsed');
                    const menuHidden = rowMenu.classList.contains('is-collapsed');
                    if (navHidden && acc > FIRST_STEP) { setRow(rowNav, false); acc = 0; }
                    else if (!navHidden && menuHidden && acc > SECOND_STEP) { setRow(rowMenu, false); }
                }
            }

            window.addEventListener('scroll', function () {
                if (!ticking) { ticking = true; requestAnimationFrame(handleScroll); }
            }, { passive: true });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSmartNavbar);
        } else {
            initSmartNavbar();
        }
    })();
</script>
