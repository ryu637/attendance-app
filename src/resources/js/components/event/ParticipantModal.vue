<template>

        <h3>出欠入力</h3>
        <input v-model="name" placeholder="名前" />

        <div v-for="candidate in event.candidate" :key="candidate.id">
          <label>{{ candidate.candidate_date }}</label>
          <div>
            <label><input type="radio" :name="candidate.candidate_date" value="yes" v-model="attendance[candidate.candidate_date]" /> ○</label>
            <label><input type="radio" :name="candidate.candidate_date" value="maybe" v-model="attendance[candidate.candidate_date]" /> △</label>
            <label><input type="radio" :name="candidate.candidate_date" value="no" v-model="attendance[candidate.candidate_date]" /> ×</label>
          </div>
        </div>

        <button @click="save">送信</button>
        <button @click="$emit('close')">閉じる</button>
  </template>

  <script setup>
  import { ref, onMounted } from "vue";

  const props = defineProps({ eventToken: String });
  const emit = defineEmits(["close", "saved"]);

  const name = ref("");
  const attendance = ref({});
  const event = ref({ date: [] });

  // イベント情報取得（候補日一覧を表示するため）
  const fetchEvent = async () => {
  try {
    const res = await fetch(`/api/event/detail/token/${props.eventToken}`);
    if (!res.ok) throw new Error(res.status);

    const data = await res.json();
    event.value = data;
    console.log(event.value);
  } catch (error) {
    console.error("イベント読み込み失敗", error);
    alert("読み込みに失敗しました。");
  }
};

const save = async () => {
  try {
    const res = await fetch(`/api/event/participant/token/${event.value.id}`, {
      method: "POST",
      headers: { "Content-Type": "application/json",
                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
       },
      body: JSON.stringify({
        name: name.value,
        attendance: attendance.value,
      }),
    });

    if (!res.ok) throw new Error(res.status);

    emit("saved"); // 親に「保存したよ！」と伝える
    emit("close"); // モーダルを閉じる
  } catch (error) {
    console.error("保存失敗", error);
    alert("保存に失敗しました。");
  }
};


  onMounted(fetchEvent);
  </script>

  <style scoped>
  /* .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
  }
  .modal-content {
    background: white;
    padding: 20px;
    margin: 10% auto;
    width: 400px;
    border-radius: 8px;
  } */
  </style>
