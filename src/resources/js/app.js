import { createApp } from 'vue';


// コンポーネント読み込み
import EventCreateForm from './components/event/EventCreateForm.vue';
import EventShow from './components/event/UrlCopyBox.vue';
import EventDetail from './components/event/EventDetail.vue';

// ページごとにマウント
// create.blade.php 用
const eventCreateAppEl = document.getElementById('event-create-app');
if (eventCreateAppEl) {
    const app = createApp({});
    app.component('event-create-form', EventCreateForm);
    app.mount(eventCreateAppEl);
}

// show.blade.php 用
const showEl = document.getElementById('event-show-app');
if (showEl) {
  const app = createApp({});
  app.component('event-show', EventShow);
  app.mount(showEl);
}

//detail.blade.php用
const detailEl = document.getElementById('event-detail-app');
if(detailEl) {
    const app = createApp({});
    app.component('event-detail', EventDetail);
    app.mount(detailEl);
}

