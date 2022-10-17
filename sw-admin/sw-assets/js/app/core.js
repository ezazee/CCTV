//run app
if(context.module !== undefined){
  const module = await import(context.loadModule())
  module.default.init();
}