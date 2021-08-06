let smartgrid  = require('smart-grid');

/* It's principal settings in smart grid project */
let settings = {
  outputStyle: 'sass', /* less || scss || sass || styl */
  columns: 12, /* number of grid columns */
  offset: '30px', /* gutter width px || % || rem */
  mobileFirst: false, /* mobileFirst ? 'min-width' : 'max-width' */
  container: {
    maxWidth: '1230px', /* max-width оn very large screen */
    fields: '15px' /* side fields */
  },
  breakPoints: {
    lg: {
      width: '1260px', /* -> @media (max-width: 1230px) */
    },
    md: {
      width: '992px'
    },
    sm: {
      width: '767px'
    },
    xs: {
      width: '576px'
    }
    /*
    We can create any quantity of break points.

    some_name: {
        width: 'Npx',
        fields: 'N(px|%|rem)',
        offset: 'N(px|%|rem)'
    }
    */
  }
};

module.exports = function () {
  $.gulp.task('smartgrid', (cb) => {
    smartgrid('./src/sass/_parts', settings);
    cb();
  });
};