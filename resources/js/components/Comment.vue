<template>
  <div class="media">
    <img 
      :src="comment.user.avatar" 
      width="50px"
      class="img-thumbnail rounded-circle mr-3"
    >
    <div class="media-body">
      <div class="container">
        <p>
          <strong>{{ comment.user.name }}</strong><br>
          <small class="text-muted">{{ comment.created_at }}</small>
          <br>{{ comment.body }}<br>
          <a href="">Edit</a>
          <a href="">Delete</a>
        </p>
      </div>
    </div>
    <div><vote :user_votes="comment.votes" :entity="comment"></vote></div>
  </div>
</template>

<script>
  export default {
    props: {
      comment: {
        type: Object,
        required: true,
        default: () => ({})
      }
    },
    
    computed: {
      commentDate() {
        return new Date(this.comment.created_at)
      }
    },
  }
</script>