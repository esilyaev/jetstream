<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
  <app-layout>
    <h1>{{ filename }}</h1>
    <canvas id="the-canvas"></canvas>
  </app-layout>
</template>

<script>
export default {
  props: {
    filename: { require: true, type: String },
  },
  mounted() {
    const loadingTask = pdfjsLib.getDocument(
      "http://jetstream.local/storage/" + this.filename
    );
    (async () => {
      const pdf = await loadingTask.promise;
      //
      // Fetch the first page
      //
      const page = await pdf.getPage(1);
      const scale = 1.5;
      const viewport = page.getViewport({ scale });
      // Support HiDPI-screens.
      const outputScale = window.devicePixelRatio || 1;

      //
      // Prepare canvas using PDF page dimensions
      //
      const canvas = document.getElementById("the-canvas");
      const context = canvas.getContext("2d");

      canvas.width = Math.floor(viewport.width * outputScale);
      canvas.height = Math.floor(viewport.height * outputScale);
      canvas.style.width = Math.floor(viewport.width) + "px";
      canvas.style.height = Math.floor(viewport.height) + "px";

      const transform =
        outputScale !== 1 ? [outputScale, 0, 0, outputScale, 0, 0] : null;

      //
      // Render PDF page into canvas context
      //
      const renderContext = {
        canvasContext: context,
        transform,
        viewport,
      };
      page.render(renderContext);
    })();
  },
};
</script>

<style>
</style>