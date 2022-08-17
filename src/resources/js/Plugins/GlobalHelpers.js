export const GlobalHelpers = {
  install: (app, options) => {
    app.config.globalProperties.$titlecase = (str) =>
      str
        ?.toLowerCase()
        .split(' ')
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
  }
};
