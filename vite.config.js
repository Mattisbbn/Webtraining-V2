import { defineConfig } from 'vite';

export default defineConfig({
  server: {
    proxy: {
      '/': 'http://mvc.test',  // Le serveur PHP tourne sur http://localhost ou autre
    }
  },
  build: {
    outDir: 'public/assets', // Où Vite va stocker les fichiers compilés (dossier public)
    manifest: true,
  },
  watch: {
    usePolling: true,  // Force Vite à utiliser une méthode de surveillance plus adaptée à Windows
    
  },
});
