jQuery(document).ready($ => {
  window.setTimeout(data => {
    $.post(data.ajaxurl, {
      nonce: data.nonce,
      action: "add_suggested",
      ip: data.ip,
      post: data.post
    }, res => {
      // No response necessary
      console.log(res)
    })
  }, 600, wpdata) //TEST
})