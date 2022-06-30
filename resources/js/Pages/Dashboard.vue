<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    name: "Posts",
    components: {
        AppLayout,
    },
    props: {
        posts: {
            type: Array,
            default: [],
        },
    },
    setup(props){

        return {

        };
    },
}
</script>
<style>
    .test{
  border-radius: 50%;
  box-shadow:
    inset 0 0 50px #fff,      /* inner white */
    inset 20px 0 80px #f0f,   /* inner left magenta short */
    inset -20px 0 80px #0ff,  /* inner right cyan short */
    inset 20px 0 300px #f0f,  /* inner left magenta broad */
    inset -20px 0 300px #0ff, /* inner right cyan broad */
    0 0 5px #fff,            /* outer white */
    -1px 0 5px #f0f,        /* outer left magenta */
    1px 0 5px #0ff; 
}

</style>
<template>
    <AppLayout title="Dashboard">
        <div v-for="post in posts" class="mt-5">
            <div class="w-[580px] pt-4 pl-4">
  <div class="flex">
    <div class="h-16 w-16">
      <img class="h-full w-16 rounded-full test" src="https://images.pexels.com/photos/10839163/pexels-photo-10839163.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="text-white  pl-4">
      <p class="pt-2"> Kathryn Murphy </p>
      <h1 class="pt-2 text-gray-500">Art</h1>
    </div>
    <div class="text-white p-6 pl-80">
      <p>...</p>
    </div>
  </div>
  <div class="w-[480px] h-[128px] border rounded-2xl ml-16 mt-4">
      <div class="ml-2 mt-1 text-white ">
        <svg width="15" height="14" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline-block"><path d="M7.5 13.333S15 10 15 4.762C15 1.667 13.304 0 11.212 0a3.72 3.72 0 0 0-2.679 1.15L8.1 1.6a.833.833 0 0 1-1.2 0l-.433-.45A3.72 3.72 0 0 0 3.788 0C1.667 0 0 1.667 0 4.762 0 10 7.5 13.333 7.5 13.333Z" fill="red"/></svg>
        <p class="inline-block pr-96">Broj</p>
        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline-block"><path d="m12 20-.305.685a.75.75 0 0 0 .61 0L12 20ZM10.76 5.38l.54-.52-.54.52Zm2.48 0-.54-.52.54.52Zm-1.96.54-.54.52.54-.52Zm1.44 0-.54-.52.54.52Zm-2.5-.019.52.54L11.82 5.4l-.52-.54-1.08 1.041Zm3.04.54.52-.54-1.08-1.04-.52.539 1.08 1.04Zm3.194-3.191A5.215 5.215 0 0 0 12.7 4.86l1.08 1.041a3.715 3.715 0 0 1 2.674-1.151v-1.5Zm5.296 6.464c0-1.99-.546-3.606-1.51-4.737-.972-1.138-2.32-1.727-3.786-1.727v1.5c1.045 0 1.97.41 2.644 1.201.68.798 1.152 2.04 1.152 3.763h1.5ZM7.546 4.75c.997 0 1.96.41 2.674 1.151l1.08-1.04A5.215 5.215 0 0 0 7.546 3.25v1.5ZM3.75 9.714c0-1.726.464-2.968 1.14-3.764.668-.788 1.591-1.2 2.656-1.2v-1.5c-1.482 0-2.831.588-3.8 1.729-.96 1.132-1.496 2.747-1.496 4.735h1.5ZM12 20l.305-.685-.004-.002-.016-.007-.068-.032a21.608 21.608 0 0 1-1.256-.652c-.82-.46-1.91-1.134-2.995-1.995-2.21-1.754-4.216-4.132-4.216-6.913h-1.5c0 3.505 2.494 6.27 4.784 8.088a24.423 24.423 0 0 0 4.652 2.879l.006.003h.002v.001L12 20Zm8.25-10.286c0 2.781-2.006 5.159-4.216 6.913a22.934 22.934 0 0 1-4.25 2.647l-.07.032-.015.007a.081.081 0 0 1-.004.002L12 20l.305.685.003-.001.006-.003a2.28 2.28 0 0 0 .105-.048c.07-.033.172-.081.3-.145a24.422 24.422 0 0 0 4.247-2.686c2.29-1.818 4.784-4.583 4.784-8.088h-1.5Zm-9.51-3.273a1.75 1.75 0 0 0 2.52 0L12.18 5.4a.25.25 0 0 1-.36 0l-1.08 1.04Z" fill="#fff"/></svg>
      </div>
      <div class="text-white mx-14 pt-3 text-center">
        <p>{{post.text}}</p>
      </div>
  </div>
</div>
        </div>
    </AppLayout>
</template>
