import {onMounted, ref} from 'vue'

export const useShowHide = ()  => {
   
    const isHide = ref(false);
    const toggleHide = () => {
        isHide.value = !isHide.value;

    }

   onMounted(() => isHide.value=false);
   
   return {isHide,toggleHide};

}