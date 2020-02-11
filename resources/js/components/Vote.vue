<template>
  <div class="quick-actions">
    <a class="quick-action text-primary" :class="{'text-danger': userHasUpVoted}" @click="vote('up')">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
    </a> {{ getTotalUpVotes }}
    <a class="quick-action text-primary" :class="{'text-danger': userHasDownVoted}" @click="vote('down')">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-down"><path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"></path></svg>
    </a> {{ getTotalDownVotes }}
  </div>
</template>

<script>
  import numeral from 'numeral'

  export default {
    props: {
      user_votes: {
        type: Array,
        required: true,
        default: () => []
      },
      entity: {
        type: Object,
        required: true,
        default: () => ({})
      }
    },
    data() {
      return {
        votes: this.user_votes
      }
    },
    methods: {
      vote(type){
        if (! __auth()) {
          return alert('login to vote')
        }

        if (__auth().id === this.entity.user_id) {
          return alert('You cannot vote yourself haha')
        }

        if (type == 'up' && this.userHasUpVoted) return

        if (type == 'down' && this.userHasDownVoted) return

        axios.post(`/votes/${this.entity.id}/${type}`)
          .then(({data}) => {
            if (this.userHasUpVoted || this.userHasDownVoted) {
              this.votes = this.votes.map(vote => {
                if (vote.user_id === __auth().id) {

                  return data
                }

                return vote
              })
            } else {
              this.votes = [
                ...this.votes, data
              ]
            }
          })
      },
    },
    computed: {
      upVotes(){
        return this.votes.filter(vote => vote.type === 'up')
      },

      downVotes(){
        return this.votes.filter(vote => vote.type === 'down')
      },

      getTotalUpVotes(){
        return numeral(
          this.upVotes.length
        )
        .format('0a')
      },

      getTotalDownVotes(){
        return numeral(
          this.downVotes.length
        )
        .format('0a')
      },

      userHasUpVoted() {
        if (! __auth()) {
          return false
        }
        return !!this.upVotes.find(vote => vote.user_id == __auth().id)
      },
      userHasDownVoted() {
        if (! __auth()) {
          return false
        }
        return !!this.downVotes.find(vote => vote.user_id == __auth().id)
      }
    }
  }
  </script>

<style scoped>
  .quick-action {

  }
</style>