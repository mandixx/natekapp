<script setup>
import { useQuotesStore } from '../stores/QuotesStore'
import { onBeforeMount, defineEmits, ref } from "vue";
const store = useQuotesStore();
const emit = defineEmits(['restart'])
</script>

<template>
    <div class="score-wrapper">
        <h2>Your score is {{ store.successAnswers }} / {{ store.maxScore }}</h2>
        <div class="score-container">
            <div class="chunk" v-for="score in store.maxScore" :key="'key' + score" :class="{'success' : score <= store.successAnswers}" />
        </div>
        <button class="reset-btn" @click="emit('restart')">RESTART</button>
    </div>

</template>

<style>

.score-container {
    display:flex;
    gap: .1rem;
    width: 20rem;
    height: 5rem;
    border-radius: 10px;
    overflow: hidden;
}

.chunk {
    width:10%;
    height: 100%;
    background-color: grey;
}

.chunk.success {
    background-color: green;
}

.score-wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.reset-btn {
    cursor: pointer;
    background-color: rgba(255, 255, 255, 0.185);
    width: 200px;
    padding: 1rem;
    margin-top: 3rem;
    border-radius: 15px;
    border: 1px solid rgba(0, 0, 0, 0.603);
    font-size: 2rem;
    transition: background-color .3s;
}

.reset-btn:hover {
    background-color: rgba(255, 255, 255, 0.589);
}
</style>