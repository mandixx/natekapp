<script setup>
import AnswerQuoteMain from "../components/AnswerQuoteMain.vue"
import AnswerQuoteScore from "../components/AnswerQuoteScore.vue"
import { useQuotesStore } from '../stores/QuotesStore'
import { onBeforeMount, ref } from "vue";

// Get quotes from backend
const store = useQuotesStore();
onBeforeMount(() => {
  store.getQuotes();
});

// Variable that stores what component are we showing currently ( Quote with Answers, Score Component )
const currentTabComponent = ref(AnswerQuoteMain)

// Switch from Quote select to score
const changeToScore = () => {
  currentTabComponent.value = AnswerQuoteScore
}
// Switch from score to Quote select view
const changeToQuoteMain = () => {
  store.getQuotes();
  currentTabComponent.value = AnswerQuoteMain
}

</script>

<template>
    <Transition name="fade" mode="out-in">
      <!-- LOADER START -->
      <div v-if="store.loading" class="loading-spinner"><div class="ldio-hit7qhu47pq"><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div></div>
      <!-- LOADER END -->
      <component v-else :is="currentTabComponent" @score="changeToScore" @restart="changeToQuoteMain"/>
    </Transition>
</template>

<style>

body {
  background: rgb(248,237,235);
  background: linear-gradient(90deg, rgba(248,237,235,1) 0%, rgba(255,181,167,1) 100%);
  user-select: none; /* Standard syntax */
}

#app {
  height: 80vh;
  display:flex;
  justify-content: center;
  align-items: center;
}


@keyframes ldio-hit7qhu47pq {
  0% {
    opacity: 1;
    backface-visibility: hidden;
    transform: translateZ(0) scale(1.5,1.5);
  } 100% {
    opacity: 0;
    backface-visibility: hidden;
    transform: translateZ(0) scale(1,1);
  }
}
.ldio-hit7qhu47pq div > div {
  position: absolute;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #8d8d8d;
  animation: ldio-hit7qhu47pq 1s linear infinite;
}.ldio-hit7qhu47pq div:nth-child(1) > div {
  left: 148px;
  top: 88px;
  animation-delay: -0.875s;
}
.ldio-hit7qhu47pq > div:nth-child(1) {
  transform: rotate(0deg);
  transform-origin: 160px 100px;
}.ldio-hit7qhu47pq div:nth-child(2) > div {
  left: 130px;
  top: 130px;
  animation-delay: -0.75s;
}
.ldio-hit7qhu47pq > div:nth-child(2) {
  transform: rotate(45deg);
  transform-origin: 142px 142px;
}.ldio-hit7qhu47pq div:nth-child(3) > div {
  left: 88px;
  top: 148px;
  animation-delay: -0.625s;
}
.ldio-hit7qhu47pq > div:nth-child(3) {
  transform: rotate(90deg);
  transform-origin: 100px 160px;
}.ldio-hit7qhu47pq div:nth-child(4) > div {
  left: 46px;
  top: 130px;
  animation-delay: -0.5s;
}
.ldio-hit7qhu47pq > div:nth-child(4) {
  transform: rotate(135deg);
  transform-origin: 58px 142px;
}.ldio-hit7qhu47pq div:nth-child(5) > div {
  left: 28px;
  top: 88px;
  animation-delay: -0.375s;
}
.ldio-hit7qhu47pq > div:nth-child(5) {
  transform: rotate(180deg);
  transform-origin: 40px 100px;
}.ldio-hit7qhu47pq div:nth-child(6) > div {
  left: 46px;
  top: 46px;
  animation-delay: -0.25s;
}
.ldio-hit7qhu47pq > div:nth-child(6) {
  transform: rotate(225deg);
  transform-origin: 58px 58px;
}.ldio-hit7qhu47pq div:nth-child(7) > div {
  left: 88px;
  top: 28px;
  animation-delay: -0.125s;
}
.ldio-hit7qhu47pq > div:nth-child(7) {
  transform: rotate(270deg);
  transform-origin: 100px 40px;
}.ldio-hit7qhu47pq div:nth-child(8) > div {
  left: 130px;
  top: 46px;
  animation-delay: 0s;
}
.ldio-hit7qhu47pq > div:nth-child(8) {
  transform: rotate(315deg);
  transform-origin: 142px 58px;
}
.loading-spinner {
  width: 200px;
  height: 200px;
  display: inline-block;
  overflow: hidden;
}
.ldio-hit7qhu47pq {
  width: 100%;
  height: 100%;
  position: relative;
  transform: translateZ(0) scale(1);
  backface-visibility: hidden;
  transform-origin: 0 0; /* see note above */
}
.ldio-hit7qhu47pq div { box-sizing: content-box; }
</style>