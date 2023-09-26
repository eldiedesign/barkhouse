// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
import templateProductGallery from './routes/product-galleries';
import templateMilestones from './routes/milestones';
import templateMediaCoverage from './routes/media-coverage';
import templateProductSingleLanding from './routes/product-landing';
import templateOrderProduct from './routes/product-order';
//import pageOrderPoplarBarkPanelWallCoveringsData from './routes/product-form';
/* import pageTemplateDefault from './routes/parallax';
import templateProducts from './routes/parallax';
import single from './routes/parallax'; */
import singleProduct from './routes/product';
import woocommerceCart from './routes/cart';
import templateCatalog from './routes/catalog';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
  //pageTemplateDefault,
  //templateProducts,
  //single,
  templateMediaCoverage,
  templateOrderProduct,
  singleProduct,
  templateCatalog,
  templateMilestones,
  templateProductGallery,
  woocommerceCart,
 // pageOrderPoplarBarkPanelWallCoveringsData,
  templateProductSingleLanding,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
