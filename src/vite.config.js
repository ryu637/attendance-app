// import { defineConfig } from 'vite';
// import vue from '@vitejs/plugin-vue';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//   plugins: [
//     laravel({
//       input: ['resources/js/app.js'],
//       refresh: true,
//     }),
//     vue(),
//   ],
// });

// import { defineConfig } from 'vite';
// import vue from '@vitejs/plugin-vue';
// import path from 'path';

// export default defineConfig({
//   plugins: [vue()],
//   resolve: {
//     alias: {
//       'vue': 'vue/dist/vue.esm-bundler.js',
//       '@': path.resolve(__dirname, 'resources/js'),
//     },
//   },
// });


import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      'vue': 'vue/dist/vue.esm-bundler.js', // ← ここ重要
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
});



