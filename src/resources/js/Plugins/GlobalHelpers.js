export const GlobalHelpers = {
  install: (app, options) => {
    app.config.globalProperties.$titlecase = (str) =>
      str
        ?.toLowerCase()
        .split(' ')
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');

    app.config.globalProperties.$dateDifference = (time) => {
      const HOURS = 24;
      const SECONDS = 60;
      const MILISECONDS = 1000;

      const DateDiff = {
        inMinutes: (custom, current) => {
          var timeCurrent = current.getTime();
          var timeNow = custom.getTime();

          return (
            Math.floor((timeCurrent - timeNow) / (SECONDS * MILISECONDS)) %
            SECONDS
          );
        },

        inHours: (custom, current) => {
          var timeCurrent = current.getTime();
          var timeNow = custom.getTime();

          return (
            Math.floor(
              (timeCurrent - timeNow) / (Math.pow(SECONDS, 2) * MILISECONDS)
            ) % HOURS
          );
        },

        inDays: (custom, current) => {
          var timeCurrent = current.getTime();
          var timeNow = custom.getTime();

          return Math.floor(
            (timeCurrent - timeNow) /
              (HOURS * Math.pow(SECONDS, 2) * MILISECONDS)
          );
        }
      };

      const customTime = new Date(time);
      const currentTime = new Date();

      return `
      ${DateDiff.inDays(customTime, currentTime)} D<br> 
      ${DateDiff.inHours(customTime, currentTime)} H<br>
      ${DateDiff.inMinutes(customTime, currentTime)} M<br>Ago
      `;
    };
  }
};
