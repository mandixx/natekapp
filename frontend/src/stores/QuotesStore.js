import { mande } from 'mande'
import { defineStore } from 'pinia'
const api = mande('http://localhost/natekapp/backend/index.php/quotes/list?XDEBUG_SESSION_START=PHPSTORM')
export const useQuotesStore = defineStore('quotes', {
  state: () => ({
    loading: false,
    maxScore: 0,
    currentQuote: {},
    quotes: [],
    successAnswers: 0
  }),
  actions: {
    async getQuotes() {
      try {
        this.loading = true;
        this.resetSuccessAnswers();
        this.quotes = await api.get(undefined, {headers: null})
        this.maxScore = this.quotes.length;
        // get random quote from the returned list
        this.assignCurrentQuote()
        this.loading = false;
      } catch (error) {
        return error
      }
    },
    assignCurrentQuote() {
      const newQuoteIndex = Math.floor(Math.random() * (this.quotes.length - 1))
      this.currentQuote = this.quotes[newQuoteIndex]
      this.quotes.splice(newQuoteIndex, 1)
    },
    resetSuccessAnswers() {
      this.successAnswers = 0;
    },
    incrementSuccessAnswers() {
      this.successAnswers++;
    }
  }
})
