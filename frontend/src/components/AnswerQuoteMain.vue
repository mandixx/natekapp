<script setup>
import { useQuotesStore } from '../stores/QuotesStore'
import { computed, ref } from "vue";
const store = useQuotesStore();
const emit = defineEmits(['score'])

let answerInfoMessage = ref('DEF');
let answered = ref(false);
const answerIsCorrect = computed(() => {
    return answerInfoMessage.value.startsWith('Correct');
});

const randomisedAnswers = computed(() => {
    let array = store.currentQuote.answers;
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array
});

const handleAnswer = (event) => {
  const answerClicked = event.target.innerHTML;
  const answerExists = store.currentQuote.answers.find((element) => element.answer === answerClicked);
  // We actually clied a box with answer and not the div background
  if(answerExists && !answered.value) {
    answered.value = true;
    const answerIsCorrect = answerExists.correct;
    if(answerIsCorrect) {
      answerInfoMessage.value = 'Correct!The right answer is ' + answerExists.answer;
      store.incrementSuccessAnswers();
    }
    else {
      const { answer } = store.currentQuote.answers.find((element) => element.correct === 1);
      answerInfoMessage.value = 'Sorry, you are wrong! The right answer is ' + answer;
    }
    // Time for the user to see if his/her answer is correct or not
    setTimeout(() => {
      answered.value = false;
      if(store.quotes.length !== 0) {
        store.assignCurrentQuote();
      } else {
        emit('score');
      }

    }, 1500);
  }
}

</script>

<template>
    <div class="container" v-if="!store.loading">
        <Transition name="fade" mode="out-in">
            <div v-if="!answered" :key="'answer-quote'">
                <div class="quote-section">
                    <p class="quote-text">
                        {{ store.currentQuote.quoteText }}
                    </p>
                </div>
                <div class="answers-section-wrapper">
                    <div class="answers-section" @click="handleAnswer">
                        <div class="quote-answer" v-for="answer in randomisedAnswers" :key="answer.answer">{{ answer.answer }}</div>
                    </div>                    
                </div>
            </div>
            <div v-else>
                <p  class="info-message" :class="{'success' : answerIsCorrect}" :key="'info-msg'">{{ answerInfoMessage }}</p>
            </div>
        </Transition>
    </div>
</template>

<style>
.container {
  position:relative;
  padding: 1rem;
  background: linear-gradient(180deg, rgba(255,142,169,1) 0%, rgba(255,181,121,1) 100%);
  font-family: 'DM Serif Text', serif;
}

.container, .quote-answer {
  border-radius: 30px;
}

.answers-section-wrapper {
    width: 70%;
    margin: auto;
}
.answers-section-wrapper::before {
    content: '';
    background-color: rgba(0, 0, 0, 0.288);
    display: block;
    margin:1rem;
    height: 1px;
}

.answers-section {
    margin: 1rem 0;
} 



.answers-section, .quote-section { 
  margin: auto;
  text-align: center;
  font-size: 1.5rem;
  width:70%;
}

.quote-answer {
  background-color: rgba(255, 255, 255, 0.829);
  padding: .5rem;
  cursor: pointer;
  transition: background-color .2s ease;
}

.quote-answer:hover {
  background-color: #ff8ea9;
}

.quote-text {
  font-weight: 600;
}

.info-message {
  width: 80%;
  margin:auto;
  color: #ee5454;
  font-size: 1.5rem;
  text-align: center;
}

.info-message.success {
  color: #3d9e4a;
}

/**
Basic transition
*/
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/**
Desktop
*/
@media (min-width: 600px) {
    .answers-section {
        display:grid;
        grid-row: auto auto;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 1rem;
        grid-row-gap: 1rem;
        position:relative;
    }

    .container {
        min-width: 40vw;
        min-width: 60vw;
    }
}
/**
Mobile
*/
@media (max-width: 600px) {
    .answers-section {
        display:flex;
        flex-direction: column;
        gap: 1rem;
    }
}
</style>