class Error {
  constructor(){
    this.errors = {}
  }

  get(field) {
    return this.errors[field]
      ? this.errors[field][0]
      : null
  }

  set(errors){
    this.errors = errors
  }

  has(field) {
    return this.errors.hasOwnProperty(field)
  }

  any() {
    return Object.keys(this.errors).length > 0
  }

  clear(field){
    delete this.errors[field]
  }
}

Vue.component('song-upload', {
  props: [],
  data: () => ({
    isUploading: false,
    selected: false,
    song: {},
    progress: 0,
    uploaded: {},
    errors: {}
  }),
  mounted() {
  },
  methods: {

    selectFile(e) {
      if (this.song.length == 0 ) { return }

      this.selected = true;
      this.song = e.target.files[0];

      const filename = document.querySelector('#selected-file');
      filename.textContent = this.song.name
    },
  
    upload() {
      this.errors = null
      this.isUploading = true
     
      const form = new FormData();
      form.append("song", this.song);
      form.append("title", this.getFileBasename(this.song.name));
      form.append("size", this.song.size);
      form.append("user_id", __auth().id);

      axios
        .post("/songs/store", form, {
          onUploadProgress: event => {
            this.progress = Math.ceil((event.loaded / event.total) * 100);
          }
        })
        .then(res => {
          this.uploaded = res.data;
          window.location.href = res.data.permalink + '/edit'
        })
        .catch(e => {
          this.errors = e.response.data.errors

          if (this.errors.song) {
            Toastr.error(this.errors.song[0])
          }

          if (this.errors.title) {
            Toastr.error(this.errors.title[0])
          }

          this.errors = {}
          this.isUploading = false
          this.progress = 0;
        })
    },
    getFileBasename(filename) {
      return filename.substr(0, filename.lastIndexOf('.'))
    },

    getFileExtention(filename)
    {
      return filename.substr(filename.lastIndexOf('.') + 1)
    }
  }
})