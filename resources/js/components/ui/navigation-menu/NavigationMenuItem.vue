<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { computed } from 'vue'
import { cn } from '@/lib/utils'
import { NavigationMenuItem, type NavigationMenuItemProps } from 'reka-ui'

const props = defineProps<NavigationMenuItemProps & { class?: HTMLAttributes['class'] }>()

const delegatedProps = computed(() => {
  const { class: _, ...rest } = props
  return rest
})
</script>

<template>
  <NavigationMenuItem
    data-slot="navigation-menu-item"
    v-bind="delegatedProps"
    :class="cn('relative', props.class)"
  >
    <slot />
  </NavigationMenuItem>
</template>
