<template>
    <div>
      <p>イベントURL: {{ eventUrl }}</p>
      <button
        :style="{ backgroundColor: copied ? 'green' : 'initial', color: copied ? 'white' : 'black' }"
        @click="copyUrl"
      >
        {{ copied ? 'コピー完了！' : 'コピー' }}
      </button>
    </div>
    <button @click="toPage">next page</button>
  </template>

  <script setup>
  import { ref } from 'vue';

  const props = defineProps({ eventToken: String });
  const eventUrl = ref(`${window.location.origin}/event/${props.eventToken}`);
  const copied = ref(false); // コピー成功フラグ

  const copyUrl = async () => {
    try {
      await navigator.clipboard.writeText(eventUrl.value);
      copied.value = true; // コピー成功
      setTimeout(() => {
        copied.value = false; // 2秒後に元の状態に戻す
      }, 2000);
    } catch (error) {
      alert('コピーに失敗しました');
    }
  };

  const toPage = () => {
    window.location.href = `/event/detail/${props.eventToken}`;
  }
    </script>
