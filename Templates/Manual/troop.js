// troop.js

function displayTime(timeInSeconds) {
    if (timeInSeconds >= 1) {
        return formatTime(timeInSeconds);
    } else if (timeInSeconds >= 0.001) {
        return (timeInSeconds * 1000).toFixed(0) + ' ms';
    } else if (timeInSeconds >= 0.000001) {
        return (timeInSeconds * 1000000).toFixed(0) + ' μs';
    } else {
        return (timeInSeconds * 1000000000).toFixed(0) + ' ns';
    }
}

function formatTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    return `${padZero(hours)}:${padZero(minutes)}:${padZero(remainingSeconds)}`;
}

function padZero(number) {
    return (number < 10 ? '0' : '') + number;
}
