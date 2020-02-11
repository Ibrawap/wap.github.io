<template>
<div class="card">
  <h5 class="card-header">
      Comments
    <a href="#" class="float-right" @click.prevent="showComments">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
    </a>
  </h5>
  <div class="card-body d-none" id="content">
    <!-- comment box -->
    <div class="media" v-show="auth">
      <img
          :src="entity.user.avatar"
          width="50px"
          class="img-thumbnail rounded-circle mr-3"
        >
      <div class="media-body">
        <div class="form-group">
            <textarea class="form-control" placeholder="Add a comment..." v-model="newComment"></textarea>
        </div>
        <button class="btn btn-sm btn-primary" @click="addComment">Post comment</button>
      </div>
    </div>
    <Comment 
      v-for="comment in comments.data" 
      :comment="comment" 
      :key="comment.id"
    />
    <div class="has-text-centered">
      <div 
        class="btn btn-sm btn-dark float-right" 
        @click="getComments" v-show="comments.next_page_url"
      > 
        Load more... 
      </div>
    </div>
  </div>
</div>
</template>

<script>
  import Comment from "./Comment.vue";

  export default {
    props: {
      entity: {
        type: Object,
        required: true,
        default: () => ({})
      }
    },

    data() {
      return {
        comments: {
          data: []
        },
        newComment: null
      }
    },

    components: {
      Comment
    },

    mounted(){
      this.getComments()
    },

    computed: {
      auth: () => !! __auth()
    },

    methods: {
      addComment() {
        if (! this.newComment) {
          return
        }

        axios.post(`/comments/${this.entity.id}`, {
          body: this.newComment,
          'user_id': __auth().id
        })  
          .then(({data}) => {
            this.comments = {
              ...this.comments,
              data: [
                data,
                ...this.comments.data,
              ]
            }
          })
          .then(() => {
            Toastr.success('Comment Added')
            this.newComment = null
          })
      },

      getComments() {
        const url = this.comments.next_page_url 
          ? this.comments.next_page_url
          : `/comments/${this.entity.id}`

        axios.get(url)
          .then(({data}) => {
            this.comments = {
              ...data,
              data: [
                ...this.comments.data,
                ...data.data
              ]
            }
          })
      },
      showComments() {
        document.getElementById('content').classList.toggle('d-none')
      }
    }
  }
</script>

<style scope>
  .card {
    margin-top: 10px;
  }
</style>