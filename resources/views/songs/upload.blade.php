@extends('layouts.app')
@section('content')
<h3 class="page__header"><i class="fas fa-upload"></i> Upload song</h3>
<song-upload inline-template>
    <div>
        <div class="card hover-to-primary mt-2">
            <div class="card-body pt-7 pb-5">
                <div class="text-center clickable" @click="$refs.song.click()">
                    <i class="fa fa-cloud-upload-alt fa-3x"></i> 
                    <h5 class="blink-slow mt-2" id="selected-file">Select/Drag And Drop File..</h5> 
                    <span class="text-danger">
                        Allowed Files: <strong class="text-primary mr-2">mp3 m4a</strong
                    </span>
                </div>
                <div class="row" v-if="!progress">
                    <div class="col col-md-6 offset-md-3 text-center mt-5">
                        <button class="btn btn-dark btn-block btn-lg" @click="upload" :disabled=!selected>
                            <i class="fa fa-cloud-upload-alt"></i> Upload & Continue
                        </button>
                    </div>
                </div>
                <div v-show="!errors && isUploading">
                    <h5 class="mt-0">@{{ progress == 100 ? "Done": "Uploading..." }}</h5>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" :style="{width: progress +'%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">@{{ progress }}%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-file d-none">
            <input 
                type="file" 
                class="custom-file-input" 
                name="song" 
                accept="audio/*" 
                ref="song"
                @change="selectFile"
            />
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>

</song-upload>

@endsection