import { GlobalComponents } from './GlobalComponents';
import { GlobalHelpers } from './GlobalHelpers';

export const Plugins = {
  install(app) {
    app.use(GlobalComponents);
    app.use(GlobalHelpers);
  }
};
