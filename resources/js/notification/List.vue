<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="panel-heading">
                    <router-link :to="{ name: 'create' }" class="btn btn-primary addButton">
                        + Add Notification
                    </router-link>
                    <h2 class="heading">Notification List</h2>
                </div>

                <table class="table table-bordered table-striped ">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Body</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr v-for="(notification, index) in notifications.data" :key="index" v-bind:key="notification.id">
                            <td>{{ notification.title }}</td>
                            <td>{{ notification.subject }}</td>
                            <td>{{ notification.body }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <router-link :to="{ name: 'edit',params: { id: notification.id } }" class="btn btn-success">Edit</router-link> &nbsp;
                                    <button class="btn btn-danger" @click="deleteProduct(notification.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
    name: 'Notification List',
    data() {
        return {
            notifications: [],
        }
    },
    created() {
        this.getList();
    },

    methods: {
        async getList() {

            await axios.get('/api/notifications').then(response => {
                this.notifications = response.data;
                //console.log(this.notifications)
            }).catch(error => {
                console.log(error)
                this.notifications = [];
            })
            console.log(this.notifications)
        },

        deleteProduct(id) {
            if(confirm("Are you sure to delete this notification ?")){
                axios.delete(`/api/notifications/${id}`).then(response=>{
                    this.getList()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>
<style>
.addButton {
    float: right;
    font-size: 18px;
    margin-top: 23px;
    cursor: pointer;
    font-weight: 600;
    margin-bottom: 35px;
}

.heading {
    text-align: center;
    margin-top: 23px;
}
</style>