<template>
    <div class="center-empty-img">
        <div class="img">
            <img
                class="empty-img"
                src="https://boti.education/lms/assets/img/icons/box.png"
            />
        </div>
    </div>
</template>

<script setup></script>

<style scoped>
.img {
    width: 150px;
    height: 150px;
}
.img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.center-empty-img {
    display: flex;
    justify-content: center;
    margin: 30px 0;
}
</style>
