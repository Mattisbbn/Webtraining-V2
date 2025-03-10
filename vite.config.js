import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  build: {
    outDir: 'public/dist', // Un seul outDir
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'public/js/main.js'), // __dirname ajouté
      },
    },
  },
  server: {
    proxy: {
      '/': 'http://mvc.test',
    },
  },
});