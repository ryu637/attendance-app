<template>
<div v-if="eventLoaded">
    <h2>{{  event.title  }} </h2>
    <table>
      <tr>
        <th>日付</th>
        <th>参加者数</th>
      </tr>
      <tr v-for="candidate in event.candidate" :key="candidate.id">
        <td>{{  candidate.candidate_date  }}</td>
        <td>data</td>
      </tr>
    </table>

    <button @click="showModal = true">  attendance </button>

    <participant-modal
  v-if="showModal"
  :event-token="props.eventToken"
  @close="showModal = false"
  @saved="fetchEvent"
/>

</div>
<div v-else>
    <p>読み込み中</p>
</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import participantModal from './participantModal.vue';

const props = defineProps({eventToken: String});
const eventLoaded = ref(false);
const event = ref({ id: null, title: '', date: [] });
const showModal = ref(false);

const fetchEvent = async() => {
    try{
        const res = await fetch(`/api/event/detail/token/${props.eventToken}`);
        // const res = await fetch(`http://localhost:8080/api/event/detail/token/${props.eventToken}`);

        if(!res.ok) {
            throw new Error('$res.status');
        }
        const data = await res.json();
        event.value = data;
        eventLoaded.value = true;
    } catch(error) {
        console.error('errorがおきました',error)
        alert('読み込みに失敗しました。')
    }
}


onMounted(fetchEvent);
</script>