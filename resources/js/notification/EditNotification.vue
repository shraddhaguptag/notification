<template>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-lg-10 col-md-10 form-group backButton">
                <router-link :to="{ name: 'home' }" class="btn btn-primary ">
                    Back to List
                </router-link>
            </div>
            <div class="col-lg-10 col-md-10 form-group">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Edit Notification</h3>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" id="title" placeholder="Title" class="form-control"
                                        v-model="notification.title">
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="subject">Subject:</label>
                                    <input type="text" name="subject" id="subject" placeholder="Notification Mail Subject"
                                        class="form-control" v-model="notification.subject">
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 form-group">
                                <label for="body">Body:</label>
                                <ckeditor :editor="editor" v-model="notification.body" :config="editorConfig"></ckeditor>

                                <!-- <textarea class="form-control" v-model="notification.body" rows="8"></textarea> -->
                            </div>
                            <div class="col-lg-12 form-group">
                                <button type="submit" class="btn btn-primary" id="update"
                                    @click.stop.prevent="update">Update</button> &NonBreakingSpace; &NonBreakingSpace;
                                <button type="button" class="btn btn-secondary" id="test"
                                    @click.stop.prevent="reset">Reset</button>
                            </div>
                            <div class="col-md-6 form-group" v-if="errors.length">
                                <p><b>Please correct the following error(s):</b>
                                <ul>
                                    <li style="color: red;" v-for="error in errors" :key="error">{{ error }}</li>
                                </ul>
                                </p>
                            </div>
                            <div class="col-md-4 form-group" text-align="center" style="color: green;" v-if="success">
                                Notification updated successfully.</div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
//import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    name: 'Create Notification',
    data() {
        return {
            notifications: [],
            notification: {
                title: '',
                subject: '',
                body: '',
            },
            errors: [],
            success: false,
            editor: ClassicEditor,
            editorConfig: {
                toolbar: {
                    items: [
                        'bold', 'italic', '|', 'link',
                        'heading', 'bulletedList', 'numberedList',
                        'blockQuote',
                        'undo',
                        'redo', 'outdent', 'indent'//,'uploadImage','mediaEmbed'
                    ],
                    shouldNotGroupWhenFull: true
                },
                image: {
                    styles: [
                        'alignCenter',
                        'alignLeft',
                        'alignRight'
                    ],
                    toolbar: [
                        'imageTextAlternative', 'toggleImageCaption', '|',
                        'imageStyle:inline', 'imageStyle:wrapText', 'imageStyle:breakText', 'imageStyle:side', '|',
                    ],
                    insert: {
                        integrations: [
                            'insertImageViaUrl'
                        ]
                    }
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },


                /*mediaEmbed: {
                    removeProviders: [ 'instagram', 'twitter', 'googleMaps', 'flickr', 'facebook' ]
                },*/
                // The configuration of the editor.

            }
        }
    },

    created() {
        this.showNotification();
    },
    methods: {

        //show details of particular notification which needs to be edit
        async showNotification() {
            await axios.get(`/api/notifications/${this.$route.params.id}`).then(response => {
                const { title, subject, body } = response.data
                this.notification.title = title
                this.notification.subject = subject
                this.notification.body = body
            }).catch(error => {
                console.log(error)
            })
        },

        //update notification
        async update() {
            this.errors = [];
            this.notification.title = this.notification.title.trim();
            this.notification.subject = this.notification.subject.trim();
            this.notification.body = this.notification.body.trim();
            if (!this.notification.title) {
                this.errors.push("Title required.");
            }
            if (!this.notification.subject) {
                this.errors.push("Subject required.");
            }
            if (!this.notification.body) {
                this.errors.push("Body required.");
            }

            if (this.errors.length) {
                return false;
            }
            await axios.put(`/api/notifications/${this.$route.params.id}`, this.notification).then(response => {
                this.$router.push({ name: "home" })
            }).catch(error => {
                console.log(error)
            })
        },
        // reset all fields of form
        reset() {
            this.notification.title = '';
            this.notification.subject = '';
            this.notification.body = '';
        },

    }
}
</script>
<style>
.backButton {
    float: right !important;
    font-size: 18px;
    margin-top: 23px;
    cursor: pointer;
    font-weight: 600;
}

.ck-editor__editable {
    min-height: 200px;
}
</style>