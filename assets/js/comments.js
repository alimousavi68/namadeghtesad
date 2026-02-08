document.addEventListener('DOMContentLoaded', function() {
    const commentForm = document.getElementById('commentform');
    const commentTextarea = document.getElementById('comment');
    const commentDetails = document.getElementById('comment-details');
    const submitBtn = document.getElementById('submit');
    const messageBox = document.getElementById('comment-message');
    const loadingSpinner = submitBtn ? submitBtn.querySelector('.loading-spinner') : null;
    const sendIcon = submitBtn ? submitBtn.querySelector('i') : null;

    // 1. Expand Form on Focus
    if (commentTextarea && commentDetails) {
        commentTextarea.addEventListener('focus', function() {
            commentDetails.classList.remove('hidden');
            commentDetails.classList.add('grid'); 
        });
    }

    // 2. Real-time Validation (Simple UI feedback)
    const requiredInputs = commentForm ? commentForm.querySelectorAll('[required]') : [];
    requiredInputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('border-rose-500');
                this.classList.add('border-slate-200', 'dark:border-slate-700');
            }
        });
        
        input.addEventListener('invalid', function(e) {
            e.preventDefault();
            this.classList.add('border-rose-500');
            this.classList.remove('border-slate-200', 'dark:border-slate-700');
        });
    });

    // 4. Reply Handling
    const replyIndicator = document.getElementById('reply-indicator');
    const replyToName = document.getElementById('reply-to-name');
    const cancelReplyBtn = document.getElementById('cancel-reply-btn');
    const commentParentInput = document.getElementById('comment_parent'); // WP creates this hidden field

    // Since reply links are dynamically generated (or could be), we delegate or just check existence.
    // WP's standard comment-reply.js handles moving the form. We just need to detect it.
    // We can listen to clicks on .comment-reply-link
    
    document.body.addEventListener('click', function(e) {
        const replyLink = e.target.closest('.comment-reply-link');
        if (replyLink) {
            e.preventDefault(); // Prevent default link behavior (refresh/jump)
            
            // Get ID from data attribute if available, or parse href
            // Standard WP `comment_reply_link` generates an onclick attribute that calls `addComment.moveForm(...)`
            // We should let that run, but `e.preventDefault()` might stop it if it's inline.
            // Actually, WP's addComment.moveForm returns false, which prevents default.
            // BUT if our custom walker output didn't include the onclick, it's just a link.
            // Our walker uses `comment_reply_link` function which usually adds the onclick.
            // However, if the user experiences a refresh, it means `return false` isn't happening or JS error.
            
            // Let's manually trigger moveForm if possible, or assume WP handles it.
            // The issue "refresh" implies the link is followed (href="...").
            // We need to ensure we don't interfere with WP's comment-reply.js script, or if we do, we handle it.
            
            // The best way to "hook" into this without breaking WP logic is:
            // 1. Let WP's onclick handler run (it returns false).
            // 2. Run our logic to update UI.
            
            // If WP's handler is missing/broken, we must preventDefault.
            
            // Get Author Name
            const commentArticle = replyLink.closest('article');
            if (commentArticle) {
                const authorElement = commentArticle.querySelector('h5');
                if (authorElement) {
                    const authorName = authorElement.textContent.trim();
                    if (replyIndicator && replyToName) {
                        replyToName.textContent = authorName;
                        replyIndicator.classList.remove('hidden');
                        replyIndicator.classList.add('flex');
                    }
                }
            }
            
            // If the link has an onclick attribute (standard WP), it should handle the move.
            // If not, we might need to manually call window.addComment.moveForm if available.
            // For now, let's assume standard WP behavior is desired but we want to ensure no refresh.
            // e.preventDefault() is safe because WP's moveForm uses DOM manipulation, not navigation.
        }
    });

    if (cancelReplyBtn) {
        cancelReplyBtn.addEventListener('click', function() {
            // Standard WP behavior usually involves clicking the #cancel-comment-reply-link
            // But since we are creating a custom UI, we might need to trigger that link's click or reset manually.
            // WP adds a hidden #cancel-comment-reply-link usually.
            const wpCancelLink = document.getElementById('cancel-comment-reply-link');
            if (wpCancelLink) {
                wpCancelLink.click(); // Let WP do its thing (move form back)
            }
            
            // Hide our indicator
            if (replyIndicator) {
                replyIndicator.classList.add('hidden');
                replyIndicator.classList.remove('flex');
            }
        });
    }

    // Also listen for WP's own cancel click (if user clicks the hidden link somehow, or we want to sync state)
    // Actually, we should just ensure our cancel button triggers the WP cancel action.

    // 3. AJAX Submission
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate manually to show custom UI
            let isValid = true;
            requiredInputs.forEach(input => {
                if (input.value.trim() === '') {
                    input.classList.add('border-rose-500');
                    isValid = false;
                }
            });

            if (!isValid) return;

            // Reset Messages
            messageBox.classList.add('hidden');
            messageBox.className = 'mt-3 text-xs font-bold hidden';
            messageBox.innerHTML = '';

            // Loading State
            if (submitBtn) {
                submitBtn.disabled = true;
                if (loadingSpinner) loadingSpinner.classList.remove('hidden');
                if (sendIcon) sendIcon.classList.add('hidden');
            }

            // Prepare Data
            const formData = new FormData(commentForm);
            formData.append('action', 'hasht_submit_comment');
            
            const ajaxUrl = window.hasht_vars ? window.hasht_vars.ajax_url : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                         // Attempt to parse JSON if content-type is wrong but body is JSON
                         try {
                             return JSON.parse(text);
                         } catch (e) {
                             throw new Error('Server Error: ' + text.substring(0, 150));
                         }
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    // Success Message
                    messageBox.classList.remove('hidden');
                    messageBox.classList.add('text-green-600');
                    messageBox.innerHTML = data.data.message;

                    // Clear Textarea
                    commentTextarea.value = '';
                    
                    // Reset hidden fields if guest
                    const authorInput = document.getElementById('author');
                    const emailInput = document.getElementById('email');
                    if (authorInput) authorInput.value = '';
                    if (emailInput) emailInput.value = '';

                    // Append Comment
                    const commentList = document.querySelector('.comment-list-container');
                    
                    // Logic to append comment
                    if (commentList) {
                        const parentId = formData.get('comment_parent');
                        
                        if (parentId && parentId !== '0') {
                            // Find parent comment container
                            // Structure: #comment-ID -> article -> children
                            const parentComment = document.getElementById('comment-' + parentId);
                            
                            if (parentComment) {
                                let childrenList = parentComment.querySelector('.children');
                                
                                if (!childrenList) {
                                    // Create children container if not exists
                                    childrenList = document.createElement('div');
                                    childrenList.className = 'children pr-4 md:pr-12 border-r-2 border-slate-100 dark:border-slate-800 mt-6 space-y-6';
                                    parentComment.appendChild(childrenList);
                                }
                                
                                // Append new comment
                                childrenList.insertAdjacentHTML('beforeend', data.data.html);
                            }
                        } else {
                            // Top level
                            commentList.insertAdjacentHTML('afterbegin', data.data.html);
                        }
                        
                        // Re-initialize Lucide icons
                        if (window.lucide) {
                            window.lucide.createIcons();
                        }
                        
                        // Scroll to new comment
                        // Extract ID from HTML or just scroll to latest
                        // (Optional enhancement)
                    }

                } else {
                    // Error Message
                    messageBox.classList.remove('hidden');
                    messageBox.classList.add('text-rose-500');
                    messageBox.innerHTML = data.data; 
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageBox.classList.remove('hidden');
                messageBox.classList.add('text-rose-500');
                // Display more specific error if available
                messageBox.innerHTML = 'خطایی رخ داد: ' + (error.message || 'لطفا مجددا تلاش کنید.');
            })
            .finally(() => {
                // Reset Button
                if (submitBtn) {
                    submitBtn.disabled = false;
                    if (loadingSpinner) loadingSpinner.classList.add('hidden');
                    if (sendIcon) sendIcon.classList.remove('hidden');
                }
            });
        });
    }
});
