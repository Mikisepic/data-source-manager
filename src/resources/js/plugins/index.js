import { GlobalComponents } from './globalComponents';
import { GlobalHelpers } from './globalHelpers';

export const Plugins = {
  install(app) {
    app.use(GlobalComponents);
    app.use(GlobalHelpers);
  }
};
