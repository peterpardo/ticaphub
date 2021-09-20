$(document).ready(function() {
    
    // ADD LIST - START
    // $(document).on('submit', '#addTaskForm', function(e){
        

  

      // TAGS
    // //   ADD MEMBER 
    // const tagContainer = document.querySelector('.tag-container');

    // const input = document.getElementById('input');
  
    // let tags = [];
  
    // function createTag(label) {
    //   // DIV
    //   const div = document.createElement('div');
    //   div.setAttribute('class', 'tag bg-blue-100 inline-flex items-center text-sm rounded mt-2 mr-1 overflow-hidden');
    //   // SPAN
    //   const span = document.createElement('span');
    //   span.innerHTML = label;
    //   span.setAttribute('class', 'ml-2 mr-1 leading-relaxed truncate max-w-xs px-1');
    //   // BUTTON
    //   const btn = document.createElement('span');
    //   btn.setAttribute('class', 'w-6 h-8 text-xl inline-block align-middle text-gray-500 bg-blue-200 focus:outline-none cursor-pointer');
    //   btn.setAttribute('data-item', label);
    //   btn.innerHTML = '&times;';
      
    //   div.appendChild(span);
    //   div.appendChild(btn);
    //   return div;
    // }
  
    // function reset() {
    //   document.querySelectorAll('.tag').forEach((tag) => {
    //     tag.parentElement.removeChild(tag);
    //   });
    // }
  
    // function addTags() {
    //   reset();
    //   tags.slice().reverse().forEach((tag) => {
    //     const input = createTag(tag);
    //     tagContainer.prepend(input);
    //   })
    // }
  
    // input.addEventListener('keyup', (e) => {
    //     if (e.key === 'Enter') {
    //       tags.push(input.value);
    //       addTags();
    //       input.value  = '';
    //     }
    // });
  
    // document.addEventListener('click', (e) => {
    //   if (e.target.tagName === 'SPAN') {
    //     const tagLabel = e.target.getAttribute('data-item');
    //     const index = tags.indexOf(tagLabel);
    //     tags = [...tags.slice(0, index), ...tags.slice(index+1)];
    //     addTags();    
    //   }
    // })
  
    // input.focus();
    // // ADD MEMBER


});