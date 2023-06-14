<template>
    <div class="container">
      <video autoplay muted loop class="bg-video">
        <source src="../../public/video/4share_bg.mp4" type="video/mp4" />
      </video>
  </div>
  </template>
  
  <style>
  .content_title {
    position: absolute;
    bottom: 10%;
    width: 50%;
    justify-content: center;
    align-items: center;
    transform: translate(50%);
  }

  
  .bg-video {
    position: absolute;
    right: 0;
    bottom: 0;
    min-width: 100%;
    min-height: 100%;
    width: 100%;
    height: auto;
    z-index: -1000;
    overflow: hidden;
    filter: brightness(0.5);
    background-size: cover;
  }

  </style>
  