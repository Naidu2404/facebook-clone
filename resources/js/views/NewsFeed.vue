<template>
    <div class="flex flex-col items-center py-4">
        <NewPost />

        <p v-if="newsStatus.postsStatus === 'loading'">Loading posts...</p>

        <Post
            v-if="posts"
            v-for="(post, postKey) in posts.data"
            :key="postKey"
            :post="post"
        />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import NewPost from "../components/NewPost.vue";
import Post from "../components/Post.vue";

export default {
    name: "NewsFeed",

    components: {
        NewPost,
        Post,
    },

    mounted() {
        this.$store.dispatch("fetchNewsPosts");
    },

    computed: {
        ...mapGetters({
            posts: "posts",
            newsStatus: "newsStatus",
        }),
    },
};
</script>
