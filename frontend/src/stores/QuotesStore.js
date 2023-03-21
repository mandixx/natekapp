import { mande } from 'mande'
import { defineStore } from 'pinia'
const api = mande(import.meta.env.VITE_BACKEND_BASE_URL + '/index.php/quotes/list')
export const useQuotesStore = defineStore('quotes', {
  state: () => ({
    loading: false,
    maxScore: 0,
    currentQuote: {},
    quotes: [],
    successAnswers: 0
  }),
  actions: {
    /**
     * Calls the API and returns the quotes from it, also depending on how much Quotes it returns it set's the maximum score that the user can have
     */
    async getQuotes() {
      try {
        this.loading = true;
        this.resetSuccessAnswers();
        this.quotes = await api.get()
        this.maxScore = this.quotes.length;
        // get random quote from the returned list
        this.assignCurrentQuote()
        this.loading = false;
      } catch (error) {
        return error
      }
    },
    /**
     * Gets random quote that the user must answer.
     */
    assignCurrentQuote() {
      const newQuoteIndex = Math.floor(Math.random() * (this.quotes.length - 1))
      this.currentQuote = this.quotes[newQuoteIndex]
      this.quotes.splice(newQuoteIndex, 1)
    },
    /**
     * Resets the successfull answers a user did on the session
     */
    resetSuccessAnswers() {
      this.successAnswers = 0;
    },
    /**
     * Increments the successfull answers a user did on the session
     */
    incrementSuccessAnswers() {
      this.successAnswers++;
    }
  }
})
