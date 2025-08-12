import { useEffect, useCallback } from 'react'

export const useCursor = () => {
  const initCursor = useCallback(() => {
    // Ensure default cursor is visible
    document.body.style.cursor = 'default'
    document.documentElement.style.cursor = 'default'

    // Removed global click animations to prevent layout shifts on click
    // and avoid attaching event listeners to every element.

    return () => {
      document.body.style.cursor = 'default'
      document.documentElement.style.cursor = 'default'
    }
  }, [])

  useEffect(() => {
    // Ensure cursor is always visible
    document.body.style.cursor = 'default'
    document.documentElement.style.cursor = 'default'

    return () => {
      document.body.style.cursor = 'default'
      document.documentElement.style.cursor = 'default'
    }
  }, [])

  return { initCursor }
}