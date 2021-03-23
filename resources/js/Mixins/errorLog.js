import swal from '@/plugin/util/swal';
export default {
    methods: {
        axiosErrorLog(err, logToConsole = false) {
            if (err.response) {
                if (logToConsole) {
                    console.log(err.response.data);
                } else {
                    swal.setTitle('Unable to process your request right now. Please try again later.').setIcon('error').toast();
                }
            } else {
                if (logToConsole) {
                    console.log(err);
                } else {
                    swal.setTitle('Network timeout. Please check your network and try again.').setIcon('error').toast();
                }
            }
        }
    }
}