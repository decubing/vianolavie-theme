jQuery(document).ready($ => {
  // Low attention
  window.setTimeout(data => {
    $.post(data.ajaxurl, {
      nonce: data.nonce,
      action: "add_suggested",
      post: data.post,
      user: data.user
    }, res => {
      // No response necessary
    })
  }, 3000, wpdata)

  // High attention
  window.setTimeout(data => {
    $.post(data.ajaxurl, {
      nonce: data.nonce,
      action: "add_suggested",
      post: data.post,
      user: data.user,
      high_attention: true
    }, res => {
      // No response necessary
    })
  }, 20000, wpdata)
})