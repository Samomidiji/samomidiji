class ArkanoidHero {
  constructor(canvasId) {
    this.canvas = document.getElementById(canvasId);
    if (!this.canvas) return;
    
    this.ctx = this.canvas.getContext('2d');
    
    // Game state
    this.gameStarted = false;
    this.gameOver = false;
    this.autoScrollTriggered = false;
    this.showTryAgain = false;
    this.tryAgainButton = null;
    
    // Ball properties
    this.ball = {
      x: 0,
      y: 100,
      dx: 8.5,
      dy: 8.5,
      radius: 8,
      color: '#6B9BD1',
      active: false
    };
    
    // Paddle properties
    this.paddle = {
      width: 120,
      height: 15,
      x: 0,
      y: 0,
      color: '#1a1a1a'
    };
    
    // Pixel blocks for "SAMUEL OMIDIJI"
    this.blocks = [];
    this.blockSize = 24; // Size of each pixel block (increased for bolder look)
    
    // Navigation bar height
    this.navHeight = 0;
    
    this.setupCanvas();
    this.init();
  }
  
  setupCanvas() {
    const updateCanvasSize = () => {
      const rect = this.canvas.getBoundingClientRect();
      this.canvas.width = rect.width;
      this.canvas.height = rect.height;
      
      // Responsive block size based on screen width
      if (this.canvas.width < 768) {
        // Mobile - larger blocks for better visibility
        this.blockSize = Math.max(10, Math.floor(this.canvas.width / 35));
        this.ball.radius = 6;
        this.ball.dx = Math.abs(this.ball.dx) > 0 ? (this.ball.dx > 0 ? 7 : -7) : 7;
        this.ball.dy = Math.abs(this.ball.dy) > 0 ? (this.ball.dy > 0 ? 7 : -7) : 7;
        this.paddle.width = 90;
      } else {
        // Desktop
        this.blockSize = 24;
        this.ball.radius = 8;
        this.ball.dx = Math.abs(this.ball.dx) > 0 ? (this.ball.dx > 0 ? 9 : -9) : 9;
        this.ball.dy = Math.abs(this.ball.dy) > 0 ? (this.ball.dy > 0 ? 9 : -9) : 9;
        this.paddle.width = 120;
      }
      
      this.createPixelText();
    };
    
    updateCanvasSize();
    window.addEventListener('resize', () => {
      updateCanvasSize();
      this.paddle.y = this.canvas.height - 80;
      this.paddle.x = (this.canvas.width - this.paddle.width) / 2;
    });
  }
  
  init() {
    // Get navigation bar height
    const nav = document.querySelector('.nav');
    if (nav) {
      this.navHeight = nav.offsetHeight;
    }
    
    // Initialize paddle position
    this.paddle.y = this.canvas.height - 80;
    this.paddle.x = (this.canvas.width - this.paddle.width) / 2;
    
    // Initialize ball position on paddle
    this.ball.x = this.canvas.width / 2;
    this.ball.y = this.paddle.y - this.ball.radius;
    
    // Create pixel text blocks
    this.createPixelText();
    
    // Event listeners for paddle control
    this.canvas.addEventListener('mousemove', (e) => this.handleMouseMove(e));
    this.canvas.addEventListener('touchmove', (e) => this.handleTouchMove(e), { passive: false });
    this.canvas.addEventListener('click', (e) => this.handleClick(e));
    this.canvas.addEventListener('touchstart', (e) => this.handleClick(e));
    
    // Game starts in ready state (ball on paddle)
    this.gameStarted = false;
    this.ball.active = false;
    
    // Auto launch ball after 2 seconds
    setTimeout(() => {
      this.launchBall();
    }, 2000);
    
    // Start animation loop
    this.animate();
  }
  
  createPixelText() {
    this.blocks = [];
    
    // Define pixel patterns for each letter - thicker version
    const letterPatterns = {
      'S': [
        [0,1,1,1,1,1],
        [1,1,1,0,0,0],
        [1,1,1,0,0,0],
        [0,1,1,1,1,0],
        [0,0,0,1,1,1],
        [0,0,0,1,1,1],
        [1,1,1,1,1,0]
      ],
      'A': [
        [0,1,1,1,1,0],
        [1,1,1,1,1,1],
        [1,1,0,0,1,1],
        [1,1,1,1,1,1],
        [1,1,0,0,1,1],
        [1,1,0,0,1,1],
        [1,1,0,0,1,1]
      ],
      'M': [
        [1,1,0,0,0,0,1,1],
        [1,1,1,0,0,1,1,1],
        [1,1,1,1,1,1,1,1],
        [1,1,0,1,1,0,1,1],
        [1,1,0,0,0,0,1,1],
        [1,1,0,0,0,0,1,1],
        [1,1,0,0,0,0,1,1]
      ],
      'U': [
        [1,1,0,0,1,1],
        [1,1,0,0,1,1],
        [1,1,0,0,1,1],
        [1,1,0,0,1,1],
        [1,1,0,0,1,1],
        [1,1,1,1,1,1],
        [0,1,1,1,1,0]
      ],
      'E': [
        [1,1,1,1,1,1],
        [1,1,1,0,0,0],
        [1,1,1,0,0,0],
        [1,1,1,1,1,0],
        [1,1,1,0,0,0],
        [1,1,1,0,0,0],
        [1,1,1,1,1,1]
      ],
      'L': [
        [1,1,0,0,0,0],
        [1,1,0,0,0,0],
        [1,1,0,0,0,0],
        [1,1,0,0,0,0],
        [1,1,0,0,0,0],
        [1,1,0,0,0,0],
        [1,1,1,1,1,1]
      ],
      'O': [
        [0,1,1,1,1,0],
        [1,1,1,1,1,1],
        [1,1,0,0,1,1],
        [1,1,0,0,1,1],
        [1,1,0,0,1,1],
        [1,1,1,1,1,1],
        [0,1,1,1,1,0]
      ],
      'I': [
        [1,1,1,1],
        [0,1,1,0],
        [0,1,1,0],
        [0,1,1,0],
        [0,1,1,0],
        [0,1,1,0],
        [1,1,1,1]
      ],
      'D': [
        [1,1,1,1,0,0],
        [1,1,0,1,1,0],
        [1,1,0,0,1,1],
        [1,1,0,0,1,1],
        [1,1,0,0,1,1],
        [1,1,0,1,1,0],
        [1,1,1,1,0,0]
      ],
      'J': [
        [0,0,0,1,1],
        [0,0,0,1,1],
        [0,0,0,1,1],
        [0,0,0,1,1],
        [1,1,0,1,1],
        [1,1,0,1,1],
        [0,1,1,1,0]
      ]
    };
    
    // Use shorter text on mobile for better fit
    const isMobile = this.canvas.width < 768;
    const text1 = isMobile ? 'SAM' : 'SAMUEL';
    const text2 = isMobile ? 'OMDJ' : 'OMIDIJI';
    
    // Calculate center position
    const totalWidth1 = text1.split('').reduce((sum, char) => {
      return sum + (letterPatterns[char]?.[0]?.length || 3) + 2;
    }, 0) * this.blockSize;
    
    const totalWidth2 = text2.split('').reduce((sum, char) => {
      return sum + (letterPatterns[char]?.[0]?.length || 3) + 2;
    }, 0) * this.blockSize;
    
    const startX1 = (this.canvas.width - totalWidth1) / 2;
    const startX2 = (this.canvas.width - totalWidth2) / 2;
    
    // Responsive positioning
    const verticalOffset = isMobile ? this.canvas.height / 2.6 : this.canvas.height / 3;
    const lineSpacing = isMobile ? (this.blockSize * 8) : 162;
    
    const startY1 = verticalOffset - (lineSpacing / 2);
    const startY2 = verticalOffset + (lineSpacing / 2);
    
    // Create blocks for first line
    let currentX = startX1;
    for (let char of text1) {
      const pattern = letterPatterns[char];
      if (pattern) {
        for (let row = 0; row < pattern.length; row++) {
          for (let col = 0; col < pattern[row].length; col++) {
            if (pattern[row][col] === 1) {
              this.blocks.push({
                x: currentX + col * this.blockSize,
                y: startY1 + row * this.blockSize,
                width: this.blockSize,
                height: this.blockSize,
                active: true,
                color: '#1a1a1a'
              });
            }
          }
        }
        currentX += (pattern[0].length + 2) * this.blockSize;
      }
    }
    
    // Create blocks for second line
    currentX = startX2;
    for (let char of text2) {
      const pattern = letterPatterns[char];
      if (pattern) {
        for (let row = 0; row < pattern.length; row++) {
          for (let col = 0; col < pattern[row].length; col++) {
            if (pattern[row][col] === 1) {
              this.blocks.push({
                x: currentX + col * this.blockSize,
                y: startY2 + row * this.blockSize,
                width: this.blockSize,
                height: this.blockSize,
                active: true,
                color: '#1a1a1a'
              });
            }
          }
        }
        currentX += (pattern[0].length + 2) * this.blockSize;
      }
    }
  }
  
  handleMouseMove(e) {
    const rect = this.canvas.getBoundingClientRect();
    const mouseX = e.clientX - rect.left;
    this.paddle.x = mouseX - this.paddle.width / 2;
    
    // Keep paddle within bounds
    if (this.paddle.x < 0) this.paddle.x = 0;
    if (this.paddle.x + this.paddle.width > this.canvas.width) {
      this.paddle.x = this.canvas.width - this.paddle.width;
    }
    
    // If ball not active, move with paddle
    if (!this.ball.active) {
      this.ball.x = this.paddle.x + this.paddle.width / 2;
    }
  }
  
  handleTouchMove(e) {
    e.preventDefault();
    const rect = this.canvas.getBoundingClientRect();
    const touch = e.touches[0];
    const touchX = touch.clientX - rect.left;
    this.paddle.x = touchX - this.paddle.width / 2;
    
    // Keep paddle within bounds
    if (this.paddle.x < 0) this.paddle.x = 0;
    if (this.paddle.x + this.paddle.width > this.canvas.width) {
      this.paddle.x = this.canvas.width - this.paddle.width;
    }
    
    // If ball not active, move with paddle
    if (!this.ball.active) {
      this.ball.x = this.paddle.x + this.paddle.width / 2;
    }
  }
  
  drawBall() {
    this.ctx.beginPath();
    this.ctx.arc(this.ball.x, this.ball.y, this.ball.radius, 0, Math.PI * 2);
    this.ctx.fillStyle = this.ball.color;
    this.ctx.fill();
    this.ctx.closePath();
  }
  
  drawPaddle() {
    this.ctx.fillStyle = this.paddle.color;
    this.ctx.fillRect(this.paddle.x, this.paddle.y, this.paddle.width, this.paddle.height);
  }
  
  drawBlocks() {
    for (let block of this.blocks) {
      if (block.active) {
        this.ctx.fillStyle = block.color;
        this.ctx.fillRect(block.x, block.y, block.width, block.height);
      }
    }
  }
  
  checkCollision() {
    // Check collision with blocks
    for (let block of this.blocks) {
      if (block.active) {
        if (
          this.ball.x + this.ball.radius > block.x &&
          this.ball.x - this.ball.radius < block.x + block.width &&
          this.ball.y + this.ball.radius > block.y &&
          this.ball.y - this.ball.radius < block.y + block.height
        ) {
          // Determine collision side
          const ballCenterX = this.ball.x;
          const ballCenterY = this.ball.y;
          const blockCenterX = block.x + block.width / 2;
          const blockCenterY = block.y + block.height / 2;
          
          const dx = ballCenterX - blockCenterX;
          const dy = ballCenterY - blockCenterY;
          
          if (Math.abs(dx) > Math.abs(dy)) {
            this.ball.dx = -this.ball.dx;
          } else {
            this.ball.dy = -this.ball.dy;
          }
          
          block.active = false;
          break;
        }
      }
    }
  }
  
  updateBall() {
    if (!this.gameStarted || this.gameOver) return;
    
    this.ball.x += this.ball.dx;
    this.ball.y += this.ball.dy;
    
    // Wall collision (left/right)
    if (this.ball.x + this.ball.radius > this.canvas.width || this.ball.x - this.ball.radius < 0) {
      this.ball.dx = -this.ball.dx;
    }
    
    // Top collision with nav bar as ceiling
    if (this.ball.y - this.ball.radius < this.navHeight) {
      this.ball.y = this.navHeight + this.ball.radius;
      this.ball.dy = -this.ball.dy;
    }
    
    // Paddle collision
    if (
      this.ball.y + this.ball.radius >= this.paddle.y &&
      this.ball.y - this.ball.radius <= this.paddle.y + this.paddle.height &&
      this.ball.x + this.ball.radius >= this.paddle.x &&
      this.ball.x - this.ball.radius <= this.paddle.x + this.paddle.width &&
      this.ball.dy > 0
    ) {
      // Add angle based on where ball hits paddle
      const hitPos = (this.ball.x - this.paddle.x) / this.paddle.width;
      this.ball.dx = (hitPos - 0.5) * 10;
      this.ball.dy = -Math.abs(this.ball.dy);
    }
    
    // Ball falls off bottom - show try again button and scroll
    if (this.ball.y - this.ball.radius > this.canvas.height) {
      if (!this.autoScrollTriggered) {
        this.autoScrollTriggered = true;
        this.gameOver = true;
        this.ball.active = false;
        this.gameStarted = false;
        this.showTryAgain = true;
        this.scrollToContent();
      }
    } else if (this.ball.y > this.canvas.height * 0.8 && !this.autoScrollTriggered) {
      // Start smooth scrolling as ball approaches bottom
      this.followBall();
    }
    
    this.checkCollision();
  }
  
  followBall() {
    // Smoothly scroll page to follow the falling ball
    const heroSection = document.getElementById('hero');
    const currentScroll = window.scrollY;
    const heroBottom = heroSection ? heroSection.offsetHeight : 0;
    const ballProgress = this.ball.y / this.canvas.height;
    
    if (ballProgress > 0.8 && currentScroll < heroBottom) {
      const targetScroll = (ballProgress - 0.8) * heroBottom * 5;
      window.scrollTo({
        top: Math.min(targetScroll, heroBottom),
        behavior: 'smooth'
      });
    }
  }
  
  scrollToContent() {
    // Complete the scroll to the works section
    const worksSection = document.getElementById('works');
    if (worksSection) {
      setTimeout(() => {
        worksSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 300);
    }
  }
  
  handleClick(e) {
    if (this.showTryAgain) {
      // Always reset game when try again is showing
      this.resetGame();
    } else {
      this.launchBall();
    }
  }
  
  launchBall() {
    if (!this.ball.active && !this.gameStarted && !this.showTryAgain) {
      this.ball.active = true;
      this.gameStarted = true;
    }
  }
  
  resetGame() {
    // Hide try again button
    this.showTryAgain = false;
    this.gameOver = false;
    this.autoScrollTriggered = false;
    
    // Reset ball position on paddle
    this.ball.x = this.paddle.x + this.paddle.width / 2;
    this.ball.y = this.paddle.y - this.ball.radius;
    this.ball.active = false;
    this.gameStarted = false;
    
    // Auto launch after 1.5 seconds
    setTimeout(() => {
      if (!this.ball.active) {
        this.launchBall();
      }
    }, 1500);
  }
  
  drawTryAgainButton() {
    if (this.showTryAgain) {
      // Responsive button sizing
      const isMobile = this.canvas.width < 768;
      const buttonWidth = isMobile ? 160 : 200;
      const buttonHeight = isMobile ? 40 : 50;
      const fontSize = isMobile ? 12 : 14;
      const buttonY = isMobile ? this.canvas.height / 2 + 140 : this.canvas.height / 2 + 180;
      
      const buttonX = (this.canvas.width - buttonWidth) / 2;
      
      // Store button bounds for click detection
      this.tryAgainButton = {
        x: buttonX,
        y: buttonY,
        width: buttonWidth,
        height: buttonHeight
      };
      
      // Draw button background (white background)
      this.ctx.fillStyle = 'rgba(255, 255, 255, 0.95)';
      this.ctx.fillRect(buttonX, buttonY, buttonWidth, buttonHeight);
      
      // Draw button border (matching existing buttons)
      this.ctx.strokeStyle = '#1a1a1a';
      this.ctx.lineWidth = 1;
      this.ctx.strokeRect(buttonX, buttonY, buttonWidth, buttonHeight);
      
      // Draw button text (matching existing button style)
      this.ctx.fillStyle = '#1a1a1a';
      this.ctx.font = `${fontSize}px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif`;
      this.ctx.textAlign = 'center';
      this.ctx.textBaseline = 'middle';
      this.ctx.letterSpacing = '0.05em';
      this.ctx.fillText('TRY AGAIN', buttonX + buttonWidth / 2, buttonY + buttonHeight / 2);
    }
  }
  
  animate() {
    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
    
    this.drawBlocks();
    this.drawBall();
    this.drawPaddle();
    this.drawTryAgainButton();
    this.updateBall();
    
    requestAnimationFrame(() => this.animate());
  }
}

// Initialize game when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  const gameCanvas = document.getElementById('arkanoidHero');
  if (gameCanvas) {
    new ArkanoidHero('arkanoidHero');
  }
});

