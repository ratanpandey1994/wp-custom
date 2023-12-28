class Search {
    // 1. Decription and create/initiate our object
    constructor() {
        this.addSearchHTML();
        this.resultsDiv = jQuery("#search-overlay__results");
        this.openButton = jQuery(".js-search-trigger");
        this.closeButton = jQuery(".search-overlay__close");
        this.searchOverlay = jQuery(".search-overlay");
        this.searchField = jQuery("#search-term");
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;
    }

    // 2. Events
    events() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        jQuery(document).on("keydown", this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }

    // 3. Methods (function, action... )
    typingLogic() {
        if (this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer);

            if (this.searchField.val()) {
                if (!this.isSpinnerVisible) {
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
            } else {
                this.resultsDiv.html("");
                this.isSpinnerVisible = false;
            }
        }

        this.previousValue = this.searchField.val();
    }

    getResults() {
        jQuery.getJSON(mainData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val(), posts => {
            jQuery.getJSON(mainData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val(), pages => {
                var combinedResults = posts.concat(pages);
                this.resultsDiv.html(`
                <h2 class="search-overlay__section-title">General Information</h2>
                ${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No gereral information matches that search.</p>'}
                   ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join("")}                
                ${combinedResults.length ? '</ul>' : ''}
            `);
                this.isSpinnerVisible = false;
            });
        });
    }

    keyPressDispatcher(e) {
        if (e.keyCode == 83 && !this.isOverlayOpen && !jQuery("input, textarea").is(':focus')) {
            this.openOverlay();
        }
        if (e.keyCode == 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active");
        jQuery("body").addClass("body-no-scroll");
        this.searchField.val('');
        setTimeout(() => this.searchField.focus(), 301)
        console.log("Our open method just ran!");
        this.isOverlayOpen = true;
    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active");
        jQuery("body").removeClass("body-no-scroll");
        console.log("Our close method just ran!");
        this.isOverlayOpen = false;
    }

    addSearchHTML() {
        jQuery("body").append(`
        <div class="search-overlay">
            <div class="search-overlay__top">
                <div class="container">
                    <i class="fa fa-search search-overlay__icon" arial-hidden="true"></i>
                    <input type="text" class="search-term" placeholder="what are you looking for?" id="search-term">
                    <i class="fa fa-close search-overlay__close" arial-hidden="true"></i>
                </div>
            </div>

            <div class="container">
                <div id="search-overlay__results"></div>
            </div>
        </div>
        `);
    }
}


const magicalSarch = new Search();