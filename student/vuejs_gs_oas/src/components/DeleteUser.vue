<template>
    <div class="absolute top-0 left-0 max-w-[946px] w-full flex justify-center items-center
        bg-white/[0.44] backdrop-opacity-[1.5]">

        <form @submit.prevent="deleteUserAndClosePopup"
            class="bg-white px-[40px] py-[30px] w-4/5 rounded-[30px] shadow-[0_4px_15px_0_rgba(0,0,0,0.35)] absolute top-[200px]">

            <h1> Are you sure you want to delete ? </h1>

            <div class="flex justify-between mt-[30px]">
                <button type="button"
                    class="border-[1px] border-[#243673] border-solid bg-white py-[9px] px-[30px] text-[20px] rounded-[10px] text-[#243673] font-semibold"
                    @click="cancelDelete()">Cancel</button>
                <button type="submit"
                    class="border-[1px] border-red-700 border-solid bg-red-700 py-[9px] px-[30px] text-[20px] rounded-[10px] text-white font-semibold">Delete</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      userIdToDelete: null,
    };
  },
  props: {
    togglePopupDelete: Function,
    deleteUserId: Number,
    popupTriggerDelete: Object,
  },
  methods: {
    togglePopupDelete() {
      if (this.popupTriggerDelete.buttonTrigger) {
        this.popupTriggerDelete.buttonTrigger = false;
      }
    },
    takeUserId() {
      this.userIdToDelete = this.deleteUserId;
      console.log("userIdToDelete:", this.userIdToDelete); // Add this line to check the value
    },
    deleteUserAndClosePopup() {
      console.log(this.userIdToDelete);
      // const url = this.$baseURL + `/api/users/${this.userIdToDelete}`
      axios.delete(`http://localhost:8000/api/users/${this.userIdToDelete}`)
        .then(response => {
          console.log("Response:", response);
          console.log("User Deleted");
          this.togglePopupDelete();
          this.$emit('user-deleted');
          this.$router.push('/list-user');
        })
        .catch(error => {
          console.log("Error:", error);
        });
    },
    cancelDelete() {
      this.togglePopupDelete();
    }
  },
  // Call takeUserId() method before calling deleteUserAndClosePopup() method
  // For example, you can call takeUserId() when the popup opens:
  mounted() {
    this.takeUserId();
  }
}
</script>