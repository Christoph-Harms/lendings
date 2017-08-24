<template xmlns:v-tooltip="http://www.w3.org/1999/xhtml">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <div style="width:150px; height:150px;">
                            <img class="media-object"
                                 src="http://lorempixel.com/150/150/people/"
                                 alt="John Doe's user image">
                        </div>
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{ user ? user.name : '' }}</h4>
                    <table class="table table-condensed">
                        <tr>
                            <th>Registriert seit:</th>
                            <td colspan="2">{{ user ? user.created_at : '' }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ user ? user.email : '' }}</td>
                            <td>
                                <button
                                        class="btn btn-default"
                                        v-tooltip:top="'Emailadresse ändern'"
                                >
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th>Passwort </th>
                            <td colspan="2"><a
                                    href="#" @click.prevent="sendResetRequest()"
                                    v-tooltip:bottom="'Passwort zurücksetzen'"
                            >reset</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'user'
        ],
        methods: {
            sendResetRequest() {
                console.log("Sending password reset request.")
            }
        }
    }
</script>