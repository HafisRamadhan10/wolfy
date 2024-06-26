// import external dependencies
import 'jquery';
import 'jquery-countdown';
import 'owl.carousel2';
import 'paroller.js';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

// base package
/*import fontawesome from "@fortawesome/fontawesome";
import faFacebook from "@fortawesome/fontawesome-free-brands/faFacebook";
import faTwitter from "@fortawesome/fontawesome-free-brands/faTwitter";*/

/** Populate Router instance with DOM routes */
const routes = new Router({
    // All pages
    common,
    // Home page
    home,
    // About Us page, note the change from about-us to aboutUs.
    aboutUs,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
