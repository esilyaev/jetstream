<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import { useForm } from "@inertiajs/inertia-vue3";
const form = useForm({
  name: null,
  file: null,
});
function submit() {
  form.post("/file");
}
</script>
<template>
  <AppLayout>
    <div class="container mx-auto">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-2">
        <form @submit.prevent="submit" class="py-5">
          <input
            class="
              mx-2
              text-base text-gray-900
              bg-gray-50
              rounded-lg
              border border-gray-300
              cursor-pointer
              dark:text-gray-400
              focus:outline-none focus:border-transparent
              dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
            "
            aria-describedby="user_avatar_help"
            id="file"
            type="file"
            @input="form.file = $event.target.files[0]"
          />

          <progress
            v-if="form.progress"
            :value="form.progress.percentage"
            max="100"
          >
            {{ form.progress.percentage }}%
          </progress>
          <button
            class="
              focus:outline-none
              text-white
              bg-green-700
              hover:bg-green-800
              focus:ring-4 focus:ring-green-300
              font-medium
              rounded-lg
              text-sm
              px-1.5
              py-1.5
              dark:bg-green-600
              dark:hover:bg-green-700
              dark:focus:ring-green-800
            "
            type="submit"
          >
            Загрузить
          </button>
        </form>
        <table
          class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
          <thead
            class="
              text-xs text-gray-700
              uppercase
              bg-gray-50
              dark:bg-gray-700 dark:text-gray-400
            "
          >
            <tr>
              <th scope="col" class="px-6 py-3">Document name</th>
              <th scope="col" class="px-6 py-3">Path</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Created at</th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
              v-for="file in files"
              :key="file.id"
            >
              <th
                scope="row"
                class="
                  px-6
                  py-4
                  font-medium
                  text-gray-900
                  dark:text-white
                  whitespace-nowrap
                "
              >
                {{ file.name }}
              </th>
              <td class="px-6 py-4">{{ file.file_path }}</td>
              <td class="px-6 py-4">Согласовано</td>
              <td class="px-6 py-4">{{ file.created_at }}</td>
              <td class="px-6 py-4 text-right">
                <a
                  :href="file.link"
                  class="
                    font-medium
                    text-blue-600
                    dark:text-blue-500
                    hover:underline
                  "
                  >Edit</a
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AppLayout>
</template>

<script>
export default {
  props: {
    files: {
      require: true,
      type: Array,
    },
  },
  mounted() {
    console.log(this.files);
  },
};
</script>