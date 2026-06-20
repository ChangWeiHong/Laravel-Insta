<template>
    <div>
        <button
            class="btn follow-button"
            :class="status ? 'btn-app-secondary' : 'btn-app-primary'"
            :disabled="processing"
            type="button"
            @click="followUser"
        >
            <span v-if="processing" class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>
            {{ buttonText }}
        </button>
    </div>
</template>

<script>
    export default {

        props: {
            userId: {
                type: [Number, String],
                required: true,
            },
            follows: {
                type: Boolean,
                required: true,
            },
        },

        data: function()
        {
            return {
                processing: false,
                status: this.follows,
            }
        },

        methods: {
            followUser() {
                this.processing = true;

                axios.post('/follow/' +this.userId)
                    .then(response => {
                        this.status = ! this.status;
                    })
                    
                    .catch (errors => {
                        if ( errors.response && errors.response.status==401 )
                        {
                            window.location = '/login';
                        }
                    })

                    .finally(() => {
                        this.processing = false;
                    });
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow': 'Follow';
            }
        }
    }
</script>
