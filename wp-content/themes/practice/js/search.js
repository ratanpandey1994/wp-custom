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

        jQuery.getJSON(mainData.root_url + '/wp-json/practice/v1/search?term=' + this.searchField.val(), (results) => {
            this.resultsDiv.html(`
                <div class="row">
                    <div class="one-third">
                        <h2  class="search-overlay__section-title">General Information </h2>
                        ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No gereral information matches that search.</p>'}
                        ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `By ${item.authorName}` : ''}</li>`).join("")}
                        ${results.generalInfo.length ? '</ul>' : ''}
                    </div>
                    <div class="one-third">
                        <h2  class="search-overlay__section-title">Programs</h2>
                        ${results.programs.length ? '<ul class="link-list min-list">' : `<p>No programs match that search. <a href="${mainData.root_url}/programs">View all programs</a></p>`}
                        ${results.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a> </li>`).join("")}
                        ${results.programs.length ? '</ul>' : ''}

                        <h2  class="search-overlay__section-title">Professors</h2>
                        ${results.professors.length ? '<ul class="professors-cards">' : `<p>No professors match that search.</p>`}
                        ${results.professors.map(item => `<li><a href="${item.permalink}">${item.title}</a> </li>`).join("")}
                        ${results.professors.length ? '</ul>' : ''}

                    </div>
                    <div class="one-third">
                        <h2  class="search-overlay__section-title">Campuses</h2>
                        ${results.campuses.length ? '<ul class="link-list min-list">' : `<p>No campuses match that search. <a href="${mainData.root_url}/campuses">View all programs</a></p>`}
                        ${results.campuses.map(item => `<li><a href="${item.permalink}">${item.title}</a> </li>`).join("")}
                        ${results.campuses.length ? '</ul>' : ''}

                        <h2  class="search-overlay__section-title">Events</h2>

                    </div>
                </div>
            `);
            this.isSpinnerVisible = false;
        })

        // jQuery.when(
        //     jQuery.getJSON(mainData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()),
        //     jQuery.getJSON(mainData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())
        // ).then((posts, pages) => {
        //     var combinedResults = posts[0].concat(pages[0]);
        //     this.resultsDiv.html(`
        //         <h2 class="search-overlay__section-title">General Information</h2>
        //         ${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No gereral information matches that search.</p>'}
        //            ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a> ${item.type == 'post' ? `By ${item.authorName}` : ''}</li>`).join("")}                
        //         ${combinedResults.length ? '</ul>' : ''}
        //     `);
        //     this.isSpinnerVisible = false;
        // }, () => {
        //     this.resultsDiv.html('<p>Unexpected error; please try again.</p>')
        // });
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