/**
 * Global Page Loader
 * Handles loading animation during page transitions
 */

class PageLoader {
    constructor() {
        this.loader = null;
        this.isLoading = false;
        this.minDisplayTime = 300; // Minimum time to show loader (prevents flash)
        this.loadStartTime = null;
        this.init();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        this.loader = document.getElementById('page-loader');
        
        if (!this.loader) {
            console.warn('Page loader element not found');
            return;
        }

        this.attachEventListeners();
        
        // Hide loader when page is fully loaded
        this.hideLoader();
    }

    attachEventListeners() {
        // Handle link clicks (internal navigation)
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            
            if (!link) return;
            
            const href = link.getAttribute('href');
            const target = link.getAttribute('target');
            
            // Skip if:
            // - External link (target="_blank")
            // - Hash link (#)
            // - JavaScript link (javascript:)
            // - Download link
            // - Has data-no-loader attribute
            if (
                target === '_blank' ||
                !href ||
                href.startsWith('#') ||
                href.startsWith('javascript:') ||
                link.hasAttribute('download') ||
                link.hasAttribute('data-no-loader')
            ) {
                return;
            }

            // Show loader for internal navigation
            this.showLoader();
        });

        // Handle form submissions
        document.addEventListener('submit', (e) => {
            const form = e.target;
            
            // Skip if form has data-no-loader attribute
            if (form.hasAttribute('data-no-loader')) {
                return;
            }

            // Skip AJAX forms (they usually handle their own loading states)
            if (form.hasAttribute('data-ajax')) {
                return;
            }

            this.showLoader();
        });

        // Hide loader when page is fully loaded
        window.addEventListener('load', () => {
            this.hideLoader();
        });

        // Handle browser back/forward buttons (bfcache)
        window.addEventListener('pageshow', (event) => {
            // If page is restored from cache, hide loader immediately
            if (event.persisted) {
                this.hideLoader(true);
            }
        });

        // Hide loader if user navigates away
        window.addEventListener('pagehide', () => {
            this.hideLoader(true);
        });

        // Hide loader on errors
        window.addEventListener('error', () => {
            this.hideLoader(true);
        });
    }

    showLoader() {
        if (this.isLoading || !this.loader) return;

        this.isLoading = true;
        this.loadStartTime = Date.now();
        
        this.loader.classList.add('show');
        document.body.classList.add('loading');
    }

    hideLoader(immediate = false) {
        if (!this.loader) return;

        const hide = () => {
            this.loader.classList.remove('show');
            document.body.classList.remove('loading');
            this.isLoading = false;
            this.loadStartTime = null;
        };

        if (immediate) {
            hide();
            return;
        }

        // Ensure loader is shown for minimum time to prevent flash
        if (this.loadStartTime) {
            const elapsed = Date.now() - this.loadStartTime;
            const remaining = Math.max(0, this.minDisplayTime - elapsed);
            
            setTimeout(hide, remaining);
        } else {
            hide();
        }
    }
}

// Initialize page loader
const pageLoader = new PageLoader();

// Export for potential use in other modules
export default pageLoader;
