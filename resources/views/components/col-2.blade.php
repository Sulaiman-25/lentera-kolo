<h4 class="my-4">Recommendation News</h4>
<div class="row g-4 mb-4">
    @foreach (\App\Models\News::where('status', 'Accept')->inRandomOrder()->take(5)->get() as $news)
        <div class="col-12">
            <div class="row g-4 align-items-center features-item">
                <div class="col-4">
                    <div class="rounded-circle position-relative">
                        <div class="overflow-hidden rounded-circle">
                            <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                class="img-zoomin img-fluid rounded-circle w-100" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="features-content d-flex flex-column">
                        <p class="text-uppercase mb-2">{{ $news->category->name }}</p>
                        <a href="{{ route('news.show', $news->slug) }}" class="h6">
                            {{ Str::limit($news->title, 40, '...') }}
                        </a>
                        <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                            {{ $news->created_at->translatedFormat('d F Y') }}</small>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<h4 class="my-4">Stay Connected</h4>
<div class="row g-4">
    <div class="col-12">
        <!-- TikTok -->
        <a href="https://vm.tiktok.com/ZSHvs7DBJJ4Th-vbkWu/"
           target="_blank"
           class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-3 text-decoration-none hover-effect">
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3"
                 style="width: 40px; height: 40px;">
                <i class="fab fa-tiktok text-dark fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <span class="text-white fw-medium">TikTok</span>
                <small class="d-block text-white-50">Follow kami di TikTok</small>
            </div>
            <i class="fas fa-external-link-alt text-white-50"></i>
        </a>

        <!-- Twitter/X -->
        <a href="https://x.com/Kelurahan_Kolo?t=JqoIVX5fQpyYA4DbHA2Iww&s=09"
           target="_blank"
           class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-3 text-decoration-none hover-effect">
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3"
                 style="width: 40px; height: 40px;">
                <i class="fab fa-twitter text-dark fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <span class="text-white fw-medium">Twitter/X</span>
                <small class="d-block text-white-50">Ikuti kami di Twitter</small>
            </div>
            <i class="fas fa-external-link-alt text-white-50"></i>
        </a>

        <!-- Facebook -->
        <a href="https://www.facebook.com/profile.php?id=61570249997037"
           target="_blank"
           class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-3 text-decoration-none hover-effect">
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3"
                 style="width: 40px; height: 40px;">
                <i class="fab fa-facebook-f text-primary fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <span class="text-white fw-medium">Facebook</span>
                <small class="d-block text-white-50">Like halaman kami</small>
            </div>
            <i class="fas fa-external-link-alt text-white-50"></i>
        </a>

        <!-- YouTube -->
        <a href="https://www.youtube.com/@Lentera_kolo"
           target="_blank"
           class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-3 text-decoration-none hover-effect">
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3"
                 style="width: 40px; height: 40px;">
                <i class="fab fa-youtube text-danger fs-5"></i>
            </div>
            <div class="flex-grow-1">
                <span class="text-white fw-medium">YouTube</span>
                <small class="d-block text-white-50">Subscribe channel kami</small>
            </div>
            <i class="fas fa-external-link-alt text-white-50"></i>
        </a>
    </div>
</div>

<style>
    .hover-effect {
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    .hover-effect:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: rgba(255,255,255,0.2);
    }
    .features-item {
        transition: all 0.3s ease;
    }
    .features-item:hover {
        background-color: rgba(52, 152, 219, 0.05);
        border-radius: 8px;
        padding: 10px;
    }
    .img-zoomin {
        transition: transform 0.3s ease;
    }
    .img-zoomin:hover {
        transform: scale(1.1);
    }
</style>

<script>
    // Smooth hover effect for social media links
    document.addEventListener('DOMContentLoaded', function() {
        const socialLinks = document.querySelectorAll('.hover-effect');

        socialLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
            });

            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });

        // News recommendation hover effect
        const newsItems = document.querySelectorAll('.features-item');
        newsItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(52, 152, 219, 0.05)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
            });
        });

        // Newsletter form submission
        const newsletterForm = document.querySelector('.input-group button');
        const emailInput = document.querySelector('input[type="email"]');

        if (newsletterForm && emailInput) {
            newsletterForm.addEventListener('click', function() {
                const email = emailInput.value;
                if (email && validateEmail(email)) {
                    // Show success message
                    showToast('Terima kasih! Anda akan menerima newsletter kami.', 'success');
                    emailInput.value = '';
                } else {
                    showToast('Masukkan email yang valid.', 'error');
                }
            });
        }

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function showToast(message, type) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `toast-alert alert alert-${type === 'success' ? 'success' : 'danger'}`;
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                animation: slideIn 0.3s ease;
            `;
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(toast);

            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Add CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
            .toast-alert {
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            }
        `;
        document.head.appendChild(style);
    });
</script>
