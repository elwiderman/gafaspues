/*!
*   Title: Gafas Pues wordpress theme
*   Description: All custom javascript overrides are here.
*   Version: 1.0.0
*   Author: Ajasra Das(das.ajasra@gmail.com)
*/
import ready from 'domready';

import AppCommon from './AppCommon';
import MainNav from './MainNav';

ready(() => {
    new AppCommon();
    new MainNav();
});