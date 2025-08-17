<template>
    <div>
      <h2>新規イベント作成</h2>
      <input v-model="title" placeholder="イベント名" />
      <textarea v-model="candidate_date" placeholder="日付(改行区切り)"></textarea>
      <button @click="createEvent">作成</button>

      <url-copy-box v-if="eventUrl" :url="eventUrl" />
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';
  import UrlCopyBox from './UrlCopyBox.vue';

  const title = ref('');
  const candidate_date = ref('');
  const eventUrl = ref('');

  const createEvent = async() => {
    try {
        const res = await fetch('api/event', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                title: title.value,
                candidate_date: candidate_date.value.split('\n')
            })
        });
        if(!res.ok) {
            throw new Error ('HTTP error! status: $(res.status)');
        }

 // 作成したイベントのIïDを取得
        const data = await res.json();
        const eventToken = data.token;
        console.log(eventToken)

    // 作成完了後に別ページにリダイレクト
    window.location.href = `/event/${eventToken}`;


    }catch(error) {
        console.error('イベント作成に失敗しました:', error);
        alert('イベント作成に失敗しました。コンソールを確認してください。');
    }
  }
  </script>