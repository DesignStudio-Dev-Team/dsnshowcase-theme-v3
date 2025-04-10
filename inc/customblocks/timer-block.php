<?php 
$timerBlock = get_field('timer_block', $block_id);
$mainImage = $timerBlock['main_image'];
$topUrgentMsg = $timerBlock['top_urgent_message'];
$bottomUrgentMsg = $timerBlock['bottom_urgent_message'];
$title = $timerBlock['title'];
$description = $timerBlock['description'];
$cta = $timerBlock['cta'];
$dateTime = $timerBlock['date_time'];
?>
<section class="dsn:my-10">
<div class="dsn:container dsn:mx-auto">
        <?php if($timerBlock) { 
         
              ?>
       <div class="dsn:w-full dsn:flex dsn:gap-10 dsn:my-10 dsn:justify-center dsn:items-center">
        <div class="dsn:w-full dsn:lg:w-1/2 dsn:p-25 dsn:text-left dsn:flex dsn:flex-col">
        <?php if($topUrgentMsg) { ?>
            <span class="dsn:text-[#D20000] dsn:font-bold"><?php echo $topUrgentMsg; ?></span>
        <?php } ?>
        <h2><?php echo $title; ?></h2>
        <p><?php echo $description; ?></p>
        <div class="dsn:flex dsn:gap-10 dsn:my-5">
            <a class="btn" href="<?php echo $cta['url']; ?>" role="button"><?php echo $cta['title']; ?></a>
    <div id="dsnCountdownTimer" class="dsn:flex dsn:gap-3 dsn:items-center">
    <div class="dsn:w-1/4 dsn:flex dsn:flex-col dsn:items-center">
        <span class="dsn:text-4xl dsn:font-bold" id="dsnCTDays">00</span>
        <span>Days</span>
    </div>
    <span class="dsn:text-4xl dsn:font-bold">:</span>
    <div class="dsn:w-1/4 dsn:flex dsn:flex-col dsn:items-center">
        <span class="dsn:text-4xl dsn:font-bold" id="dsnCTHours">00</span>
        <span>Hours</span>
    </div>
    <span class="dsn:text-4xl dsn:font-bold">:</span>
    <div class="dsn:w-1/4 dsn:flex dsn:flex-col dsn:items-center">
        <span class="dsn:text-4xl dsn:font-bold" id="dsnCTMinutes">00</span>
        <span>Minutes</span>
    </div>
    <span class="dsn:text-4xl dsn:font-bold">:</span>
    <div class="dsn:w-1/4 dsn:flex dsn:flex-col dsn:items-center">
        <span class="dsn:text-4xl dsn:font-bold" id="dsnCTSeconds">00</span>
        <span>Seconds</span>
    </div>
</div>
        </div>
       <?php if($bottomUrgentMsg) { ?>
        
        <div class="dsn:relative dsn:bg-[#FDD5D5] dsn:text-[#D20000] dsn:text-center dsn:p-4 dsn:w-full dsn:max-w-2xl dsn:mx-auto dsn:my-5 dsn:rounded-md">
    <div class="dsn:absolute dsn:top-1 dsn:left-3/4 dsn:-translate-x-1/2 dsn:-translate-y-3/4 dsn:w-4 dsn:h-4 dsn:bg-[#FDD5D5] dsn:rotate-45"></div>
    <span class="dsn:font-bold"><?php echo $bottomUrgentMsg; ?></span>
    </div>

        <?php } ?>
      
        </div>
        <div class="dsn:p-0 dsn:w-full dsn:lg:w-1/2">
         <img class="dsn:w-full dsn:h-full" src="<?php echo $mainImage; ?>" alt="image">
        </div>
        </div>
        <?php }  ?>
</div>
</section>
<style>
    #dsnCountdownTimer {
        color: #AC0000
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var countDownDate = new Date(<?php echo $dateTime ? json_encode($dateTime) : 'null'; ?>).getTime();

    if (!countDownDate) {
        console.error("Countdown date is invalid.");
        return;
    }

    var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        console.log(distance);  

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("dsnCTDays").innerHTML = "00";
            document.getElementById("dsnCTHours").innerHTML = "00";
            document.getElementById("dsnCTMinutes").innerHTML = "00";
            document.getElementById("dsnCTSeconds").innerHTML = "00";
            return;
        }

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if (days < 10) days = '0' + days;
        if (hours < 10) hours = '0' + hours;
        if (minutes < 10) minutes = '0' + minutes;
        if (seconds < 10) seconds = '0' + seconds;

        document.getElementById("dsnCTDays").innerHTML = days;
        document.getElementById("dsnCTHours").innerHTML = hours;
        document.getElementById("dsnCTMinutes").innerHTML = minutes;
        document.getElementById("dsnCTSeconds").innerHTML = seconds;
    }, 1000);
});


</script>