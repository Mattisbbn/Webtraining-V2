import browserSync from 'browser-sync';

export default function () {
  return {
    name: 'vite-plugin-browser-sync',
    configureServer(server) {
      browserSync.init({
        proxy: 'mvc.test',  // Ton serveur PHP (assure-toi qu'il tourne sur ce port)
        files: ['public/**/*', 'views/**/*.php'], // Spécifie les fichiers à surveiller
        reloadDelay: 1000,
      });

      // Recharger la page si un fichier PHP change
      server.middlewares.use((req, res, next) => {
        if (req.url && req.url.endsWith('.php')) {
          browserSync.reload();
        }
        next();
      });
    }
  };
}
